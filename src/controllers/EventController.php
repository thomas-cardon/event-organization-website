<?php

final class EventController
{
    use ControllerHelpers;

    public function seeAction($params, $post, $session)
    {
        User::ensureExists();
        $id = $params[0];
        $event = array(
                    'id' => 1,
                    'title' => 'Tournoi de tennis',
                    'description' => "Le tennis de table est un évènement pour rassembler les étudiants tous, et il y a l'éducation dans la belle sienne en haut jusqu'au bout bon rouge. Et son ou une nouveler le roi du crise parfait que je vais à des âmeurs présentables sur ce quête mêmes au plus grand toujours: cette région beaucoup soufflement ne faut pas entre mes guillemets and donc sa plage français bien faiteux noir ; puisque ma peine avoir san",
                    'author' => 'Jane Doe',
                    'date' => '2020-01-01',
                    'time' => '10:00',
                    'location' => 'Paris',
                    'owner' =>  array(
                        'id' => 1,
                        'firstName' => 'Jane',
                        'lastName' => 'Doe',
                        'email' => 'test.test@test.fr',
                        'avatar' => 'https://i.pravatar.cc/300',
                        'role' => 'admin',
                        'created_at' => '',
                        'updated_at' => ''
                    )
                );// TODO: get event from DB by id

        View::show('event', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? null,
            'body' => View::get('event/see', array(
                'event' => $event
            ))
        ));

        $_SESSION['alert'] = null;
    }
}
?>