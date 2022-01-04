<?php

final class SignupController
{
    use ControllerHelpers;

    /**
    * @todo: Afficher la page d'inscription ?
    * En fait, je n'étais pas sûr, car j'ai l'impression que ce n'est pas nécessaire, je cite:
    * "Le login / mot de passe est défini arbitrairement par un administrateur dans un premier temps"
    * @see https://www.mickael-martin-nevot.com/univ-amu/iut/dut-informatique/programmation-web-cote-serveur/?:s24-projet.pdf
    * @author Thomas Cardon
    */
    public function defaultAction()
    {
        /* ControllerHelpers#redirect arrête le script immédiatement */
        $this->redirect('/', array('alert' => array('message' => 'Cette action est désactivée.', 'type' => 'yellow')));
        
        User::ensureExists();

        if ($this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous êtes déjà connecté.', 'type' => 'blue')));

        View::show('signup', array(
            'authentified' => false
        ));
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
            $user->setHash(password_hash($password, PASSWORD_DEFAULT)) ;
            $user->save();
            $message =  'Voici vos identifiants pour se connecter à E-event.io\n'.
                'email: '.$user->getEmail().'\n'.
                'mot de passe: '.$password;

            mail($user->getEmail(),"vos identifiant pour se conecter à E-event.io",$message);

            return $password;
        }

        throw new Exception('Utilisateur inconnu');
    }

}

?>