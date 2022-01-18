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
                $this->increment($user);

                if ($user->getConnectionCount() > 1) {
                    $_SESSION['user'] = $user;
                    $this->redirect('/', array( 'alert' => array('message' => 'Connexion réussie.', 'type' => 'green')));
                }
                else
                    $this->redirect('/signin/edit-password', array( 'alert' => array('message' => 'Veuillez changer votre mot de passe.', 'type' => 'green')));
            }
            else $this->userError('Vos identifiants sont incorrects.');
        }
        else $this->userError('Aucun utilisateur avec cet identifiant existe.');
    }

    private function userError($msg, $type = 'red') {
        $this->redirect('/signin', array('alert' => array('message' => $msg, 'type' => $type)));
    }

    public function editPasswordAction($params, $post, $session){
        if (!$this->isAuthentified())
            $this->redirect('/signin', array('alert' => array('message' => 'Vous devez être connecté pour accéder à cette page.', 'type' => 'red')));

        if (isset($post['password1']) && isset($post['password2'])) {
            $user = $session['user'];
            if($post['password1'] == $post['password2'])
            {
                $user->setHash(password_hash($_POST['password1'], PASSWORD_DEFAULT));
                $user->update();
                $this->redirect('/', array('alert' => array('message' => 'Modification réussie', 'type' => 'green')));
            }
            else $this->redirect('/signin/edit-password', array('alert' => array('message' => 'Les mots de passe ne correspondent pas', 'type' => 'red')));
        }
        
        View::show('editPassword', array(
            'authentified' => $this->isAuthentified(),
            'user' => $session['user'] ?? null,
            'alert' => $session['alert'] ?? null,
        ));
    }

    private function increment(User $user){
        $user->setConnectionCount($user->getConnectionCount() + 1);
        $user->update();
    }

    /**
     * Envoie les données de connexions de l'utilisateur par mail
     * @return string Mot de passe généré aléatoirement non hashé
     * @author Thomas Cardon, Enzo Vargas, Justin De Sio, Adrien Lacroix
     */
    public function resetPasswordAction($params, $post, $session): string
    {
        if (!isset($_GET['email']))
            $this->redirect('/', array('alert' => array('message' => 'Veuillez renseigner votre adresse e-mail.', 'type' => 'red')));

        $user = User::getByEmail($_GET['email']);

        if (!$user)
            $this->redirect('/', array('alert' => array('message' => 'Aucun utilisateur avec cet e-mail n\'a été trouvé.', 'type' => 'red')));

        $password = (new SignupController)->generateRandomPassword();
        $user->setHash(password_hash($password, PASSWORD_DEFAULT));
        $user->save();

        $to = $user->getEmail();
        $subject = 'Changement de mot de passe E-EVENT.IO !';
        $message = 'Votre mot de passe a été réinitialisé'."\n" .
            'Voici vos identifiants pour se connecter à E-event.io'."\n" .
            'Email: ' . $user->getEmail() . "\n" .
            'Mot de passe: ' . $password . "\n" .
            'Votre mot de passe est généré aléatoirement, vous devrez le changer lors de votre première connexion.';
        mail($to, $subject, $message);

        if (!mail($user->getEmail(), "E-Event.IO | Vos identifiants", $message))
            throw new Exception('Erreur lors de l\'envoi du mail');

        $this->redirect('/', array('alert' => array('message' => 'Votre mot de passe a été réinitialisé, vous allez recevoir un mail contenant vos identifiants.', 'type' => 'green')));
    }
}

?>