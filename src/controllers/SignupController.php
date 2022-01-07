<?php

final class SignupController
{
    use ControllerHelpers;

    public function defaultAction()
    {
        if ($this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous êtes déjà connecté.', 'type' => 'blue')));

        View::show('signup', array(
            'authentified' => false,
            'user' => null,
            'alert' => $session['alert'] ?? null,
        ));
    }

    public function SignUpAction($param, $post, $session)
    {
        //on vérifie si l'utilisateur est déja connecté
        if ($this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous êtes déjà connecté.', 'type' => 'blue')));
        //si les champs sont vides affiche une erreur
        else if (empty($post['email']) || empty($post['nom']) || empty($post['prenom']))
            $this->userError('Veuillez remplir tous les champs.');
        $this->checkExist($post['email']);

    }

    private function checkExist($email)
    {
        //On vérifie si l'utilisateur existe déja
        $user = User::getByEmail($email);
        if ($user)
        {
           $this->userError('Votre compte existe déja, ou cet email est déja utilisé');
        }
    }

    private function userError($msg, $type = 'red') {
        $this->redirect('/signup', array('alert' => array('message' => $msg, 'type' => $type)));
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
     * Génère un mot de passe aléatoire pour un utilisateur spécifié, le hashe et l'enregistre dans la base de données
     * @todo: créer une action pour le tableau de bord qui utilisera cette fonction et enverra un mail, afin
     * que l'administrateur puisse réinitialiser les mots de passes des utilisateurs
     * @return string Mot de passe généré aléatoirement non hashé
     * @author Thomas Cardon
     */
    public static function resetPassword($userId) {
        $user = User::getById($userId);
        if ($user) {
            $password = (new SignupController)->generateRandomPassword(uniqid());
            $user->setHash(password_hash($password, PASSWORD_DEFAULT));
            $user->save();

            $message =  'Voici vos identifiants pour se connecter à E-event.io\n'.
                'Email: '.$user->getEmail().'\n' .
                'Mot de passe: '. $password . '\n' .
                'Votre mot de passe est généré aléatoirement, vous devrez le changer lors de votre première connexion.';

            mail($user->getEmail(), "E-Event.IO | Vos identifiants", $message);

            return $password;
        }

        throw new Exception('Utilisateur inconnu');
    }

}

?>