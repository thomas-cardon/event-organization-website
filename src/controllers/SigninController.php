<?php

final class SigninController
{
    use ControllerHelpers;

    public function defaultAction($params, $post, $session)
    {
        if ($this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous êtes déjà connecté.', 'type' => 'blue')));

        View::show('signin', array(
            'authentified' => false,
            'user' => null,
            'alert' => $session['alert'] ?? null,
        ));
    }

    public function authAction($params, $post, $session) {
        // On vérifie si l'utilisateur est déjà authentifié
        if ($this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous êtes déjà connecté.', 'type' => 'blue')));
        else if (empty($post['email']) || empty($post['password']))
            $this->userError('Veuillez remplir tous les champs.');

        $this->checkCredentials($post['email'], $post['password']);
    }

    public function logoutAction($params, $post, $session) {
        // On vérifie si l'utilisateur est déjà authentifié
        if ($this->isAuthentified()) {
            session_destroy();
            $this->redirect('/', array('alert' => array('message' => 'Déconnexion réussie.', 'type' => 'green')));
        }
        else
            $this->redirect('/', array('alert' => array('message' => 'Vous devez déjà être connecté pour pouvoir vous déconnecter.', 'type' => 'red')));

    }

    /**
     *  Proposition d'implémentation de la connexion de l'utilisateur
     *  @param $email string
     *  @param $password string
     *  @author Thomas Cardon
     */
    private function checkCredentials($email, $password)
    {
        $user = User::getByEmail($email);
        if ($user) {
            if (password_verify($password, $user->getHash())) {
                $_SESSION['user'] = $user;
                if ($user->getConnectionCpt() > 1010 ) {
                    $this->incrementCountCpt($user);
                    $this->redirect('/', array('alert' => array('message' => 'Connexion réussie..', 'type' => 'green')));
                }
                else {
                    $this->incrementCountCpt($user);
                    View::show('editPassword', array(
                        'authentified' => $this->isAuthentified(),
                        'alert' => $session['alert'] ?? null,
                        'user' => $_SESSION['user'] ?? null
                    ));

                }

            }
            else $this->userError('Vos identifiants sont incorrects.');
        }
        else $this->userError('Aucun utilisateur avec cet identifiant existe.');
    }

    public function editPasswordAction($password){
        $user = $_SESSION['user'];

//        $user->setHash(password_hash($password, PASSWORD_DEFAULT));
        $user->setHash($_POST['password1']);

        $user->update();
        $this->redirect('/', array('alert' => array('message' => 'modification réussie..', 'type' => 'green')));
    }

    private function userError($msg, $type = 'red') {
        $this->redirect('/signin', array('alert' => array('message' => $msg, 'type' => $type)));
    }

    private function incrementCountCpt(User $user){
        $user->setConnectionCpt($user->getConnectionCpt()+1);
        $user->update();
    }



    /**
     * Envoie les données de connexions de l'utilisateur par mail
     * @return string Mot de passe généré aléatoirement non hashé
     * @author Thomas Cardon, Enzo Vargas, Justin De Sio, Adrien Lacroix
     */
    public static function resetPasswordAction($userId): string
    {
        $user = User::getById($userId);

        if (isset ($user)) {

            $password = (new SignupController)->singnupController::generateRandomPassword();
            $user->setHash(password_hash($password, PASSWORD_DEFAULT));
            $user->save();

            $to = $user->getEmail();
            $subject = 'Changement de mot de passe E-EVENT.IO !';
            $message = 'Votre mot de passe a été réinitialisé.\n' .
                'Voici vos identifiants pour se connecter à E-event.io\n' .
                'Email: ' . $user->getEmail() . '\n' .
                'Mot de passe: ' . $password . '\n' .
                'Votre mot de passe est généré aléatoirement, vous devrez le changer lors de votre première connexion.';
            mail($to, $subject, $message);

            if (!mail($user->getEmail(), "E-Event.IO | Vos identifiants", $message))
                throw new Exception('Erreur lors de l\'envoi du mail');

            return $password;
        }
    }
}

?>