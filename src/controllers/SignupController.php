<?php

final class SignupController
{
    use ControllerHelpers;

    public function defaultAction($params, $post, $session)
    {
        if ($this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous êtes déjà connecté.', 'type' => 'blue')));
        View::show('signup', array(
            'authentified' => false,
            'user' => null,
            'alert' => $session['alert'] ?? null,
        ));
    }

    /**
     * Checks user data and creates user
     * @author Enzo Vargas
     */
    public function postAction()
    {
        // On vérifie si l'utilisateur est déja connecté
        if ($this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous êtes déjà connecté.', 'type' => 'blue')));
        //si les champs sont vides affiche une erreur
        else if (empty($_POST['email']) || empty($_POST['lastName']) || empty($_POST['firstName']))
            $this->userError('Veuillez remplir tous les champs.');

        
        /* @todo: vérifier que l'adresse mail est valide */

        // On vérifie si l'utilisateur existe déja
        $user = User::getByEmail($_POST['email']);
        
        if ($user) $this->userError('Votre compte existe déjà, ou cette adresse-mail est déjà utilisée');
        else $this->createUser();
    }

    private function createUser()
    {
        $user = new User($_POST['email'], $_POST['firstName'], $_POST['lastName'], self::resetPassword(null, $_POST['email'], true));
        $user->save();
        if ($user) {
            $session = array(
                'user' => $user,
                'alert' => array('message' => 'Inscription réussie.', 'type' => 'green')
            );

            $_SESSION = $session;
            $this->redirect('/');    
        }
    }

    private function userError($msg, $type = 'red') {
        $this->redirect('/signup/', array('alert' => array('message' => $msg, 'type' => $type)));
    }

    /**
     * Génère un mot de passe aléatoire
     * @param $chars int Nombre de caractères du mot de passe
     * @return string
     * @author Thomas Cardon
     */
    private function generateRandomPassword($chars = 12): string {
        $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $shfl = str_shuffle($comb);
        return substr($shfl,0, $chars);
    }

    public function changePassword($userId,$password){
        $user = User::getById($userId);
        $user->setHash(password_hash($password, PASSWORD_DEFAULT));
        $user->update();
    }

    /**
     * Génère un mot de passe aléatoire pour un utilisateur spécifié, le hashe et l'enregistre dans la base de données
     * @return string Mot de passe généré aléatoirement non hashé
     * @author Thomas Cardon, Enzo Vargas, Justin De Sio
     */
    public static function resetPassword($userId,$mail, $new = true): string {
        $user = User::getById($userId);

        if ($new) {
            $password = (new SignupController)->generateRandomPassword();

            $message =  'Voici vos identifiants pour se connecter à E-event.io\n' .
                'Email: '. ($mail ?? $user->getEmail()) .'\n' .
                'Mot de passe: '. $password . '\n' .
                'Votre mot de passe est généré aléatoirement, vous devrez le changer lors de votre première connexion.';
                
            if (!mail($user->getEmail(), "E-Event.IO | Vos identifiants", $message))
                throw new Exception('Erreur lors de l\'envoi du mail');
            
            return $password;
        }
        else if ($user) {
            $password = (new SignupController)->generateRandomPassword();
            $user->setHash(password_hash($password, PASSWORD_DEFAULT));
            $user->update();

            $message = 'Votre mot de passe a été réinitialisé.\n' .
                'Voici vos identifiants pour se connecter à E-event.io\n' .
                'Email: '.$user->getEmail().'\n' .
                'Mot de passe: '. $password . '\n' .
                'Votre mot de passe est généré aléatoirement, vous devrez le changer lors de votre première connexion.';
                    
            if (!mail($user->getEmail(), "E-Event.IO | Vos identifiants", $message))
                throw new Exception('Erreur lors de l\'envoi du mail');

            return $password;
        }
        else throw new Exception('L\'utilisateur demandé n\'existe pas.');
    }

}

?>