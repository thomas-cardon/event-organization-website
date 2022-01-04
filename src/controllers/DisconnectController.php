<?php

class DisconnectController
{
    use ControllerHelpers;

    public function DiscAction($params, $post, $session) {
        // On vérifie si l'utilisateur est déjà authentifié
        if ($this->isAuthentified())
            session_destroy();
        else
            $this->userError('Vous n\'êtes pas connecté');

    }

    private function userError($msg, $type = 'red') {
        $this->redirect('/signin', array('alert' => array('message' => $msg, 'type' => $type)));
    }

}