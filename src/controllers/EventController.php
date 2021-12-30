<?php

final class EventController
{
    use ControllerHelpers;

    public function seeAction($params, $post, $session)
    {        
        $id = $params[0];
        $event = array(
                    'id' => 1,
                    'campaignId' => 1,
                    'title' => 'Tournoi de tennis',
                    'description' => "Le tennis de table est un évènement pour rassembler les étudiants tous, et il y a l'éducation dans la belle sienne en haut jusqu'au bout bon rouge. Et son ou une nouveler le roi du crise parfait que je vais à des âmeurs présentables sur ce quête mêmes au plus grand toujours: cette région beaucoup soufflement ne faut pas entre mes guillemets and donc sa plage français bien faiteux noir ; puisque ma peine avoir san",
                    'author' => 'Jane Doe',
                    'created_at' => '2020-01-01',
                    'from' => '2020-01-01 10:00:00',
                    'to' => '2020-01-01 12:00:00',
                    'location' => 'Paris',
                    'points' => 100,
                    'owner' =>  array(
                        'id' => 1,
                        'firstName' => 'Jane',
                        'lastName' => 'Doe',
                        'email' => 'test.test@test.fr',
                        'avatar' => 'https://i.pravatar.cc/300',
                        'role' => 'admin',
                        'created_at' => '',
                        'updated_at' => ''
                    ),
                    'unlockableContent' => array(
                        array(
                            'title' => 'Raquettes 3000',
                            'description' => 'De nouvelles raquettes pour les joueurs',
                            'lockedContent' => 'Contenu débloqué.',
                            'pointsRequired' => 1,
                            'video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                            'textColor' => '#000000'
                        ),
                        array(
                            'title' => '+10 personnes',
                            'description' => '10 personnes seront ajoutées à la liste des participants',
                            'lockedContent' => 'Contenu débloqué.',
                            'pointsRequired' => 1000,
                            'video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                            'textColor' => '#000000'
                        ),
                        array(
                            'title' => 'Titre du contenu',
                            'description' => 'Description du contenu',
                            'lockedContent' => 'Cette partie ne sera affichée que lorsque le contenu sera débloqué.',
                            'pointsRequired' => 3000,
                            'image' => 'https://i.pravatar.cc/1000',
                            'video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
                        )
                    )

                );// TODO: get event from DB by id

        View::show('event', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? null,
            'body' => View::get('event/see', array(
                'event' => $event,
                'donations' => Transaction::findByEventId($id)
            ))
        ));

        $_SESSION['alert'] = null;
    }

    public function winnersAction() {
        View::show('event', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? null,
            'body' => View::get('event/winners', array(
                'winners' => array()
            ))
        ));

        $_SESSION['alert'] = null;
    }
}
?>