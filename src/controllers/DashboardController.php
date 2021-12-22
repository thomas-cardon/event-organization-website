<?php

/**
 * Back-office dashboard controller
 */
final class DashboardController
{
    use ControllerHelpers;

    public function defaultAction($params, $post, $session)
    {
        User::ensureExists();
        
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
            )
        ));

        $_SESSION['alert'] = null;
    }

    public function createUserAction($params, $post, $session)
    {
        User::ensureExists();
        
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

    public function createCampaignAction($params, $post, $session)
    {
        User::ensureExists();
        
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
            'content' => View::get('dashboard/createCampaign')
        ));

        $_SESSION['alert'] = null;
    }
}