<?php

/**
 * Back-office dashboard controller
 */
final class DashboardController
{
    use ControllerHelpers;

    public function defaultAction($params, $post, $session)
    {
        if (false)//if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'warn')));

        View::show('dashboard', array(
            'authentified' => true,//$this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? array( 
                'id' => 0,
                'firstName' => 'Jane', 
                'lastName' => 'Doe',
                'email' => 'jane.doe@test.te',
                'avatar' => 'https://i.pravatar.cc/300',
                'role' => 'organizer', /* admin, organizer, jury, donor, member */
                'created_at' => '',
                'updated_at' => ''
            )
        ));

        $_SESSION['alert'] = null;
    }

    public function createUserAction($params, $post, $session)
    {
        if (false)//if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'warn')));

        View::show('dashboard', array(
            'authentified' => true,//$this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? array( 
                'id' => 0,
                'firstName' => 'Jane', 
                'lastName' => 'Doe',
                'email' => 'jane.doe@test.te',
                'avatar' => 'https://i.pravatar.cc/300',
                'role' => 'admin', /* admin, organizer, jury, donor */
                'created_at' => '',
                'updated_at' => ''
            ),
            /**
             * Ici, on est obligés d'utiliser View::get pour l'avoir en variable
             */
            'content' => View::get('dashboard/createUser')
        ));

        $_SESSION['alert'] = null;
    }

    public function editCampaignAction($params, $post, $session)
    {
        if (false)//if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'warn')));

        View::show('dashboard', array(
            'authentified' => true,//$this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? array( 
                'id' => 0,
                'firstName' => 'Jane', 
                'lastName' => 'Doe',
                'email' => 'jane.doe@test.te',
                'avatar' => 'https://i.pravatar.cc/300',
                'role' => 'admin', /* admin, organizer, jury, donor */
                'created_at' => '',
                'updated_at' => ''
            ),
            'content' => View::get('dashboard/editCampaign', array('edit' => true))
        ));

        $_SESSION['alert'] = null;
    }

    public function createCampaignAction($params, $post, $session)
    {
        if (false)//if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'warn')));

        View::show('dashboard', array(
            'authentified' => true,//$this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? array( 
                'id' => 0,
                'firstName' => 'Jane', 
                'lastName' => 'Doe',
                'email' => 'jane.doe@test.te',
                'avatar' => 'https://i.pravatar.cc/300',
                'role' => 'admin', /* admin, organizer, jury, donor */
                'created_at' => '',
                'updated_at' => ''
            ),
            'content' => View::get('dashboard/editCampaign', array('edit' => false))
        ));

        $_SESSION['alert'] = null;
    }

    public function editEventAction($params, $post, $session)
    {
        if (false)//if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'warn')));

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

        View::show('dashboard', array(
            'authentified' => true,//$this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? array( 
                'id' => 0,
                'firstName' => 'Jane', 
                'lastName' => 'Doe',
                'email' => 'jane.doe@test.te',
                'avatar' => 'https://i.pravatar.cc/300',
                'role' => 'admin', /* admin, organizer, jury, donor */
                'created_at' => '',
                'updated_at' => ''
            ),
            'content' => View::get('dashboard/editEvent', array( 'edit' => true, 'event' => $event ))
        ));

        $_SESSION['alert'] = null;
    }

    public function createEventAction($params, $post, $session)
    {
        if (false)//if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'warn')));
        
        View::show('dashboard', array(
            'authentified' => true,//$this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? array( 
                'id' => 0,
                'firstName' => 'Jane', 
                'lastName' => 'Doe',
                'email' => 'jane.doe@test.te',
                'avatar' => 'https://i.pravatar.cc/300',
                'role' => 'admin', /* admin, organizer, jury, donor */
                'created_at' => '',
                'updated_at' => ''
            ),
            'content' => View::get('dashboard/editEvent', array( 'edit' => false ) )
        ));

        $_SESSION['alert'] = null;
    }
}