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

        

        // On vérifie si l'utilisateur existe déja
        $user = User::getByEmail($_POST['email']);
        
        if ($user) $this->userError('Votre compte existe déjà, ou cette adresse-mail est déjà utilisée');
        else $this->createUser();
    }

    /**
     * Génère un mot de passe aléatoire pour un utilisateur spécifié, le hashe et l'enregistre dans la base de données
     * @author Thomas Cardon, Enzo Vargas, Justin De Sio, Adrien Lacroix
     */
    private function createUser()
    {
        $user = new User($_POST['email'], $_POST['firstName'], $_POST['lastName'], '$2y$10$ecbqAqsHQZ.xXVzCN93P5ucVv7J4vUlNDeCZ315HsxLzPdaYwXsMC');
        $password = $this->generateRandomPassword();
        $user->setHash(password_hash($password, PASSWORD_DEFAULT));
        $user->save();
        self::sendMail( $_POST['email'], $password);
        if ($user) {
            $session = array(
                'user' => $user,
                'alert' => array('message' => 'Inscription réussie.'."\n".'Vous venez de recevoir un email avec vos identifiants de connexion (regardez dans vos spams)', 'type' => 'green')
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
    public function generateRandomPassword($chars = 12): string {
        $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $shfl = str_shuffle($comb);
        return substr($shfl,0, $chars);
    }

    /**
     * Envoie les données de connexions de l'utilisateur par mail
     * @return string Mot de passe généré aléatoirement non hashé
     * @author Thomas Cardon, Enzo Vargas, Justin De Sio, Adrien Lacroix
     */
    public static function sendMail($mail, $password): string
    {
        $user = User::getByEmail($mail);

        $to = $user->getEmail();
        $subject = 'Bienvenue sur E-EVENT.IO !';
        $message = 'Voici vos identifiants pour se connecter à E-event.io'."\n" .
            'Email: ' . $user->getEmail() . "\n" .
            'Mot de passe: ' . $password . "\n" .
            'Votre mot de passe est généré aléatoirement, vous devrez le changer lors de votre première connexion.';
        
        mail($to, $subject, $message);

        if (!mail($to, $subject, $message))
            throw new Exception('Erreur lors de l\'envoi du mail');
            
        return $password;
    }
}
