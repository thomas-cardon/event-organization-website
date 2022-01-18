<?php

/**
 * Back-office dashboard controller
 */
final class DashboardController
{
    use ControllerHelpers;

    public function defaultAction($params, $post, $session)
    {
        if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'yellow')));
            
        View::show('dashboard', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? null,

            'current_campaign' => Campaign::getCurrentCampaign(),
            'current_campaign_events' => Campaign::getCurrentCampaign() ? Event::findByCampaignId(Campaign::getCurrentCampaign()->getId()) : null,
            'recent_users' => $session['cached_recent_users'] ?? $session['user']->getRole() === 'admin' ? User::find(5) : null,
            'recent_events' => $session['cached_recent_events'] ?? $session['user']->getRole() === 'admin' || $session['user']->getRole() === 'organizer' ? Event::find(5) : null,
            'nb_users_per_role' => $session['user']->getRole() === 'admin' ? User::nbCountPerRole() : null,
            'sum_points' => $session['user']->getRole() === 'admin' ? User::sumPoints() : null,
            'hide_all_users_button' => isset($session['cached_recent_users'])
        ));

        $_SESSION['alert'] = null;
        $_SESSION['cached_recent_users'] = null;
    }

    /**
     * Création d'un nouvel utilisateur, avec un mot de passe temporaire
     * Endpoint: /dashboard/create-user
     * @param $params array
     * @param $post array
     * @param $session array
     * @author Thomas Cardon
     */
    public function voteAction($params, $post, $session)
    {
        if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'yellow')));

        if (isset($params[0])) {
            $eventId = $params[0];

            if (!Event::find($eventId))
                $this->redirect('/', array('alert' => array('message' => 'L\'événement n\'existe pas.', 'type' => 'red')));
            
            if (!Campaign::getPendingForVoteCampaign())
                $this->redirect('/', array('alert' => array('message' => 'Il n\'y a pas de campagne en cours.', 'type' => 'red')));
            
            if ($session['user']->getRole() !== 'admin' && $session['user']->getRole() !== 'jury')
                $this->redirect('/', array('alert' => array('message' => 'Vous n\'avez pas les droits pour effectuer cette action.', 'type' => 'red')));
                        
            $vote = new Vote($eventId, $session['user']->getId());
            $vote->save();

            $session['alert'] = array('message' => 'Votre vote a bien été pris en compte.', 'type' => 'green');
        }

        View::show('dashboard', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? null,
            'content' => View::get('dashboard/vote', array(
                'user' => $session['user'] ?? null,
                'campaign' => Campaign::getPendingForVoteCampaign(),
                'campaign_events' => Campaign::getPendingForVoteCampaign() ? Event::findByCampaignId(Campaign::getPendingForVoteCampaign()->getId()) : null,
            ))
        ));

        $_SESSION['alert'] = null;
    }


    public function createUserAction($params, $post, $session)
    {
        if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'yellow')));
        
        if ($session['user']->getRole() !== 'admin')
            $this->redirect('/', array('alert' => array('message' => 'Vous n\'avez pas les droits pour effectuer cette action.', 'type' => 'red')));
        
        if (isset($post['firstname'])) {
            if (empty($post['firstname']) || empty($post['lastname']) || empty($post['email']) || empty($post['password']) || empty($post['role']))
                $this->redirect('/dashboard/create-user', array('alert' => array('message' => 'Les valeurs sont obligatoires.', 'type' => 'red')));
            
            $pwd = (new SignupController)->generateRandomPassword();
            $user = new User($post['email'], $post['firstname'], $post['lastname'], password_hash($pwd, PASSWORD_DEFAULT), 0);
            $user->setRole($post['role']);
            $user->save();

            SignUpController::sendMail($user->getEmail(), $pwd);

            $session['alert'] = array('message' => 'L\'utilisateur a bien été créé.', 'type' => 'green');
        }
        View::show('dashboard', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'],
            /**
             * Ici, on est obligés d'utiliser View::get pour l'avoir en variable
             */
            'content' => View::get('dashboard/editUser', array('edit' => false))
        ));

        $_SESSION['alert'] = null;
    }

    public function editUserAction($params, $post, $session)
    {
        if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'yellow')));
        
        if ($session['user']->getRole() !== 'admin')
            $this->redirect('/', array('alert' => array('message' => 'Vous n\'avez pas les droits pour effectuer cette action.', 'type' => 'red')));

        if (!isset($params[0]))
            $this->redirect('/dashboard', array('alert' => array('message' => 'Vous devez spécifier un utilisateur.', 'type' => 'yellow')));

        $user = User::getById($params[0]);

        if (!$user)
            $this->redirect('/dashboard', array('alert' => array('message' => 'L\'utilisateur spécifié n\'existe pas.', 'type' => 'yellow')));
        
        if (!isset($post['firstname']) || !isset($post['lastname']) || !isset($post['email']) || !isset($post['role']))
            $this->redirect('/dashboard/edit-user/' . $user->getId(), array('alert' => array('message' => 'Les valeurs sont obligatoires.', 'type' => 'red')));
        
        $user->setFirstName($post['firstname']);
        $user->setLastName($post['lastname']);
        $user->setEmail($post['email']);
        $user->setRole($post['role']);
        $user->save();

        View::show('dashboard', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'],
            'content' => View::get('dashboard/editUser', array(
                'edit' => true,
                'user' => $user
            ))
        ));

        $_SESSION['alert'] = null;
    }

    /**
     * Edition d'une campagne existante
     * Endpoint: /dashboard/edit-campaign
     * @param $params array
     * @param $post array
     * @param $session array
     * @author Thomas Cardon
     */
    public function editCampaignAction($params, $post, $session)
    {
        if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'yellow')));

        View::show('dashboard', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'],
            'content' => View::get('dashboard/editCampaign', array('edit' => true))
        ));

        $_SESSION['alert'] = null;
    }

    /**
     * Création d'une nouvelle campagne
     * Endpoint: /dashboard/create-campaign
     * @param $params array
     * @param $post array
     * @param $session array
     * @author Thomas Cardon
     */
    public function createCampaignAction($params, $post, $session)
    {
        if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'yellow')));

        if ($session['user']->getRole() !== 'admin')
            return $this->redirect('/', array('alert' => array('message' => 'Vous n\'avez pas les droits pour effectuer cette action.', 'type' => 'yellow')));

        if (!empty($post)) {
            try {
                $d1 = new DateTime($post['datedep']);
                $d2 = new DateTime($post['datefin']);

                if ($d1 > $d2)
                    $session['alert'] = array('message' => 'La date de fin de la campagne doit être supérieure à la date de début.');
                else if ($d1 < new DateTime())
                    $session['alert'] = array('message' => 'La date de fin de la campagne doit être supérieure ou égale à la date d\'aujourd\'hui.');
                if (Campaign::isBetween($d1->format('Y-m-d'), $d2->format('Y-m-d')))
                    $session['alert'] = array('message' => 'Une campagne est déjà en cours à cette période', 'type' => 'red');
                else {
                    $campaign = new Campaign($post['Nom'], $post['Description'], $d1->format('Y-m-d'), $d2->format('Y-m-d'));
                    $campaign->save();

                    return $this->redirect('/dashboard', array('alert' => array('message' => 'La campagne a bien été créée.', 'type' => 'green')));
                }
            }
            catch (Exception $e) {
                $session['alert'] = array('message' => $e->getMessage(), 'type' => 'red');
            }
        }

        View::show('dashboard', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'],
            'content' => View::get('dashboard/editCampaign', array('edit' => false))
        ));

        $_SESSION['alert'] = null;
    }

    /**
     * Edition d'un évènement existant
     * Endpoint: /dashboard/edit-event
     * @param $params array
     * @param $post array
     * @param $session array
     * @author Thomas Cardon
     */
    public function editEventAction($params, $post, $session)
    {
        if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'yellow')));

        if (!$session['user']->getRole() === 'admin' && !$session['user']->getRole() === 'organizer')
            $this->redirect('/', array('alert' => array('message' => 'Vous n\'avez pas les droits pour effectuer cette action.', 'type' => 'yellow')));

        $event = Event::getById($params[0]);

        if (!$event)
            $this->redirect('/dashboard', array('alert' => array('message' => 'Cet évènement n\'existe pas.', 'type' => 'yellow')));

        View::show('dashboard', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'],
            'content' => View::get('dashboard/editEvent', array( 'edit' => true, 'event' => $event, 'unlockableContent' => UnlockableContent::findByEventId($event->getId()) ))
        ));

        $_SESSION['alert'] = null;
    }

    /**
     * Création d'un nouvel évènement
     * Endpoint: /dashboard/create-event
     * @param $params array
     * @param $post array
     * @param $session array
     * @author Thomas Cardon
     */
    public function createEventAction($params, $post, $session)
    {
        if (!$this->isAuthentified())
            return $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'yellow')));
        
        if ($session['user']->getRole() !== 'admin')
            return $this->redirect('/', array('alert' => array('message' => 'Vous n\'avez pas les droits pour effectuer cette action.', 'type' => 'yellow')));
        
        if (!empty($post)) {
            try {

                $event = new Event($_POST['Nom'], $_POST['Description'], $session['user']->getId(), Campaign::getCurrentCampaign()->getId(), $_POST['DateDep'], $_POST['DateFin']);
                $event->save();

                if (!empty($_POST['unlockableContent'])) {
                    foreach ($_POST['unlockableContent'] as $unlockableContent) {
                        $content = new UnlockableContent(
                            null,
                            $unlockableContent['title'],
                            $unlockableContent['description'],
                            Event::lastInsertId(),
                            $unlockableContent['points']
                        );
                        $content->save();
                    }
                }
                $session['alert'] = array('message' => 'Evènement créé avec succès.', 'type' => 'green');
            }
            catch (Exception $e) {
                $session['alert'] = array('message' => $e->getMessage(), 'type' => 'red');
            }
        }

        View::show('dashboard', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'],
            'content' => View::get('dashboard/editEvent', array( 'edit' => false ) )
        ));
    }


    public function usersAction($params, $post, $session)
    {
        if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'yellow')));

        if ($session['user']->getRole() !== 'admin')
            $this->redirect('/dashboard', array('alert' => array('message' => 'Vous n\'avez pas les droits pour effectuer cette action.', 'type' => 'yellow')));

        $session['cached_recent_users'] = User::find();
        return $this->defaultAction($params, $post, $session);
    }

    public function resetPasswordAction($params, $post, $session)
    {
        if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'yellow')));

        if ($session['user']->getRole() !== 'admin')
            $this->redirect('/dashboard', array('alert' => array('message' => 'Vous n\'avez pas les droits pour effectuer cette action.', 'type' => 'yellow')));
        
        $id = $params[0];

        if (!$id)
            $this->redirect('/dashboard', array('alert' => array('message' => 'L\'identifiant de l\'utilisateur est manquant.', 'type' => 'red')));
        
        try {
            SignupController::resetPassword($id, false);
            $this->redirect('/dashboard',  array('alert' => array('message' => 'Le mot de passe de l\'utilisateur a été réinitialisé. Le mail à normalement été envoyé à l\'adresse mail reliée au compte.', 'type' => 'green')));
        } catch (Exception $e) {
            $this->redirect('/dashboard',  array('alert' => array('message' => $e->getMessage(), 'type' => 'red')));
        }
    }

    public function addPointsAction($params, $post, $session)
    {
        if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'yellow')));
        
        if ($session['user']->getRole() !== 'admin')
            $this->redirect('/dashboard', array('alert' => array('message' => 'Vous n\'avez pas les droits pour effectuer cette action.', 'type' => 'yellow')));
        
        $id = $params[0];

        if (!$id)
            return $this->redirect('/dashboard', array('alert' => array('message' => 'L\'identifiant de l\'utilisateur est manquant.', 'type' => 'red')));
        
        $user = User::getById($id);

        if (!$user)
            return $this->redirect('/dashboard', array('alert' => array('message' => 'Cet utilisateur n\'existe pas.', 'type' => 'red')));

        if (isset($post['amount'])) {
            $user->setPoints($user->getPoints() + $post['amount']);
            $user->save();

            return $this->redirect('/dashboard', array('alert' => array('message' => $user->getName() . ' : ' . ($post['amount'] > 0 ? '+' : '') . $post['amount'], 'type' => 'green')));
        }
        
        View::show('dashboard', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'],
            'content' => View::get('dashboard/addPoints', array( 'edit' => false, 'target' => $user ))
        ));

        $_SESSION['alert'] = null;
    }

    public function accountAction($params, $post, $session) {
        if (!$this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous devez être connecté pour effectuer cette action.', 'type' => 'yellow')));

        View::show('dashboard', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'],
            'content' => View::get('dashboard/me', array('user' => $session['user']))
        ));
    }
}