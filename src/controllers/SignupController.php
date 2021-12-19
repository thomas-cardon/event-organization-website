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
}

?>