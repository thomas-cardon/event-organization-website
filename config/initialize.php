<?php
/**
 * Pour des raisons de sécurité, ce script
 * doit être exécuté, puis supprimé.
 * Ce fichier vous permettra d'initialiser d'une traite la base de données.
 * PENSEZ à créer les fichiers de configuration de votre projet. (voir fichiers sql.example.php et config.example.php)
 */


$p = dirname(__FILE__);
if (file_exists($p . '/config.php')) require_once $p . '/config.php';
else die('Le fichier de configuration n\'existe pas.');

if (file_exists($p . '/sql.php')) require_once $p . '/sql.php';
else die('Le fichier de configuration de la base de données SQL n\'existe pas.');

$sql = [
    'SET FOREIGN_KEY_CHECKS = 0',
    'DROP TABLE IF EXISTS `transactions`',
    'DROP TABLE IF EXISTS `campaigns`',
    'DROP TABLE IF EXISTS `events`',
    'DROP TABLE IF EXISTS `users`',
    'DROP TABLE IF EXISTS `votes`',

    'SET FOREIGN_KEY_CHECKS = 1',
    /* A partir d'ici, ce sont des exemples de requêtes générées auendDatematiquement */

    //table des utilisateurs
    'CREATE TABLE `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `first_name` varchar(255) NOT NULL,
        `last_name` varchar(255) NOT NULL,
        `hash` varchar(255),
        `email` varchar(255) NOT NULL,
        `role` varchar(255) NOT NULL DEFAULT \'donor\',
        `points` int(11) NOT NULL DEFAULT 0,
        `connection_count` int(11) NOT NULL DEFAULT 0,
        `avatar` varchar(255),
        `created_at` DATETIME DEFAULT NOW(),
        `updated_at` DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8',

    //table des campagnes
    'CREATE TABLE IF NOT EXISTS `campaigns` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `startDate` DATE NOT NULL,
        `endDate` DATE NOT NULL,
        `created_at` DATETIME DEFAULT NOW(),
        `updated_at` DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8',

    //table des évènements
    'CREATE TABLE IF NOT EXISTS `events` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `author` int(11) NOT NULL,
        `campaign_id` int(11) NOT NULL,
        `status` varchar(255) NOT NULL DEFAULT \'pending\',
        `startDate` DATETIME NOT NULL,
        `endDate` DATETIME NOT NULL,
        `created_at` DATETIME DEFAULT NOW(),
        `updated_at` DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY (`id`),
        FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`)  ON DELETE CASCADE,
        FOREIGN KEY (`author`) REFERENCES `users`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8',

    //table des contenus déblocables des évènements
    'CREATE TABLE IF NOT EXISTS `unlockable_content` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `points_required` int(11) NOT NULL,
        `event_id` int(11) NOT NULL,
        `author` int(11) NOT NULL,
        `created_at` DATETIME DEFAULT NOW(),
        `updated_at` DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY (`id`),
        FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
        FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8',

    //table de transaction des dons
    'CREATE TABLE `transactions` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `event_id` int(11) NOT NULL,
        `amount` int(11) NOT NULL,
        `created_at` DATETIME DEFAULT NOW(),
        `comment` TEXT,
        PRIMARY KEY (`id`),
        FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
        FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8',

    // table de vote pour les jurys
    'CREATE TABLE `votes`(
        `event_id`int(11) NOT NULL,
        `user_id` int(11) NOT NULL,
        FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE,
        FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
        CONSTRAINT `votes_unique` UNIQUE (`user_id`, `event_id`)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8'
];


$sql_data = [


    "INSERT INTO `users` (`id`, `first_name`, `last_name`, `hash`, `email`, `role`, `created_at`, `updated_at`) VALUES
        (1, 'Jane', 'Doe', '$2y$10\$ecbqAqsHQZ.xXVzCN93P5ucVv7J4vUlNDeCZ315HsxLzPdaYwXsMC', 'test.test@test.fr', 'admin', '2021-12-29 12:08:25', '2021-12-29 12:08:54'),
        (2, 'Thor', 'Odinson', '$2y$10\$ecbqAqsHQZ.xXVzCN93P5ucVv7J4vUlNDeCZ315HsxLzPdaYwXsMC', 'thomas.cardon@etu.univ-amu.fr', 'organizer', '2021-12-29 12:08:25', '2021-12-29 12:08:54'),
        (3, 'John', 'Doe', '$2y$10\$ecbqAqsHQZ.xXVzCN93P5ucVv7J4vUlNDeCZ315HsxLzPdaYwXsMC', 'test1.test2@test.fr', 'donor', '2021-12-29 12:08:25', '2021-12-29 12:08:54'),
        (4, 'Heureux', 'Donateur', '$2y$10\$ecbqAqsHQZ.xXVzCN93P5ucVv7J4vUlNDeCZ315HsxLzPdaYwXsMC', 'heureux.donateur@test.fr', 'donor', '2021-12-29 12:08:25', '2021-12-29 12:08:54');",

    "INSERT INTO `campaigns` (`id`, `name`, `description`, `startDate`, `endDate`) VALUES
        (1, 'Intégration première année', 'Cette campagne vise à faire les présentations entre les première et deuxième années', '2021-9-01', '2021-9-10'),
        (2, 'Mois du sport', 'Cette campagne vise à promouvoir le sport pendant le mois de Janvier', '2021-12-29', '2022-2-01');",

    "INSERT INTO `events` (`id`, `name`, `author`,`campaign_id`, `description`, `startDate`, `endDate`, `created_at`, `updated_at`) VALUES
        (1, 'Soirée au bord de la plage', 1,2, 'Cette soirée est organisée par le BDE', '2021-9-04 21:00:00', '2021-9-05 00:00:00', '2021-09-01 00:00:00', '2021-09-01 00:00:00'),
        (2, 'Soirée dans le centre-ville', 2,2, 'Cette soirée est organisée par le comité étudiant Aix en Provence', '2021-9-04 21:00:00', '2021-9-05 00:00:00', '2021-09-01 00:00:00', '2021-09-01 00:00:00'),
        (3, 'event2', 1,1, 'la description', '2021-12-29 11:40:36', '2022-01-01 11:40:36', '2021-12-29 11:40:36', '2021-12-29 12:51:19');",

    "INSERT INTO `transactions` (`id`, `user_id`, `event_id`, `amount`, `created_at`, `comment`) VALUES (1, 1, 2, 10, '2021-12-29 11:40:36', 'comment');",
];

$sql_triggers = [
    "
        DROP EVENT IF EXISTS reset_donors_points_event;

        DELIMITER | 
        CREATE EVENT reset_donors_points_event
        ON SCHEDULE EVERY 1 DAY
            DO
            BEGIN
                UPDATE users
                SET points = " . DONOR_POINTS_GIVEN_FOR_EACH_CAMPAIGN . "
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
            UPDATE users SET users.points = " . DONOR_POINTS_GIVEN_FOR_EACH_CAMPAIGN . " where users.role = 'donor';
        END |

        DELIMITER ;
    "];
$db = Model::getDatabaseInstance();

echo '<pre>';
echo '<h1>Initialisation de la base de données</h1>';

echo '</ul>';

echo '<h2>Création des tables</h2>';
echo '<ul>';
foreach ($sql as $query) {
    echo '<li>' . $query . '</li>';
    $db->query($query);
}

echo '<h2>Création des triggers</h2>';
echo '<ul>';
foreach ($sql_triggers as $query) {
    echo '<li>' . $query . '</li>';
    $db->query($query);
}

echo '</ul>';
echo '<h2>Création des données</h2>';
echo '<ul>';
foreach ($sql_data as $query) {
    echo '<li>' . $query . '</li>';
    $db->query($query);
}


echo '</ul>';

echo '<h3><i>Utilisateurs créé avec par défaut le mot de passe: <code>this is a test password</code></i><h3>';

echo '<h1>Goodbye</h1>';
echo '<h2>Ce script est maintenant inutile, il à été renommé en .old.php.</h2>';

rename($p . '/initialize.php', $p . '/initialize.old.php');