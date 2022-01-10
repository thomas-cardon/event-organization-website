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

    public function SignUpAction()
    {
        //on vérifie si l'utilisateur est déja connecté
        if ($this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous êtes déjà connecté.', 'type' => 'blue')));
        //si les champs sont vides affiche une erreur
        else if (empty($_POST['email']) || empty($_POST['nom']) || empty($_POST['prenom']))
            $this->userError('Veuillez remplir tous les champs.');
        $this->checkExist($_POST['email']);

    }

    private function checkExist($email)
    {
        //On vérifie si l'utilisateur existe déja
        $user = User::getByEmail($email);
        if ($user)
        {
           $this->userError('Votre compte existe déja, ou cet email est déja utilisé');
        }
        else{
             $this->createUser();
        }
    }

    private function createUser()
    {
        $user = new User($_POST['email'], $_POST['prenom'], $_POST['nom'], self::sendPassword());
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
    private function generateRandomPassword($chars = 12) {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz!$%&/()=?*+-_.,;:';
        return substr(str_shuffle($data), 0, $chars);
    }

    /**
     * Génère un Hash à partir du mot de passe generer grâce à generateRandomPassword() et envoie un email avec le mot le mdp
     * @return string
     * @author Enzo Vargas et Justin De Sio
     */
    public static function sendPassword() {
            $password = (new SignupController)->generateRandomPassword();
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
            $message =  'Voici vos identifiants pour se connecter à E-event.io\n'.
                'email: '.$_POST['email'].'\n'.
                'mot de passe: '.$password;

            //Marche pas sur Xampp
            //mail($_POST['email'],"vos identifiant pour se conecter à E-event.io",$message);

            return $hashedpassword;
        }

        /**
     * Génère un mot de passe aléatoire pour un utilisateur spécifié, le hashe et l'enregistre dans la base de données
     * @todo: créer une action pour le tableau de bord qui utilisera cette fonction et enverra un mail, afin
     * que l'administrateur puisse réinitialiser les mots de passes des utilisateurs
     * @return string Mot de passe généré aléatoirement non hashé
     * @author Thomas Cardon
     */
    public static function resetPassword($userId) {
        $user = User::getById($userId);
        if ($user) {
            $password = (new SignupController)->generateRandomPassword();
            $user->setHash(password_hash($password, PASSWORD_DEFAULT)) ;
            $user->save();
            $message =  'Voici vos identifiants pour se connecter à E-event.io\n'.
                'email: '.$user->getEmail().'\n'.
                'mot de passe: '.$password;

            //Marche pas sur Xampp
            //mail($user->getEmail(),"vos identifiant pour se conecter à E-event.io",$message);

            return $password;
        }

        throw new Exception('Utilisateur inconnu');
    }

}

?>