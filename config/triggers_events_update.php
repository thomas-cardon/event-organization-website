<?php

$points = DONOR_POINTS_GIVEN_FOR_EACH_CAMPAIGN;
if (POINTS_WEBSERVICE_URL) {
    $p = json_decode(file_get_contents(POINTS_WEBSERVICE_URL . '/points-bank-rest-api/get.php'), true);
    if ($p) {
        $points = $points['data']['points_to_share'] / User::nbCountForRole('donor');
    }
}

$sql_triggers = [
    "
        DROP EVENT IF EXISTS reset_donors_points_event;

        DELIMITER | 
        CREATE EVENT reset_donors_points_event
        ON SCHEDULE EVERY 1 DAY
            DO
            BEGIN
                UPDATE users
                SET points = " . $points . "
                WHERE users.role = 'donor' AND EXISTS(SELECT * FROM campaigns WHERE DATE(startDate) = DATE(NOW()));
            END |

        DELIMITER ;
    ",
    "
        DROP TRIGGER IF EXISTS set_points_for_donor_inserted;

        DELIMITER |

        CREATE OR REPLACE TRIGGER set_points_for_donor_inserted
        AFTER INSERT
        ON users FOR EACH ROW
        BEGIN
            UPDATE users SET users.points = " . $points . " where users.role = 'donor';
        END |

        DELIMITER ;
    "];
$db = Model::getDatabaseInstance();

foreach ($sql_triggers as $query) {
    echo '<li>' . $query . '</li>';
    $db->query($query);
}