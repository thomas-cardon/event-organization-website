<?php

final class SigninController
{
    use ControllerHelpers;

    public function defaultAction()
    {
        User::ensureExists();

        if ($this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous êtes déjà connecté.', 'type' => 'blue')));

        View::show('signin');
    }

    public function authAction($params, $post, $session) {
        User::ensureExists();

        // On vérifie si l'utilisateur est déjà authentifié
        if ($this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous êtes déjà connecté.', 'type' => 'blue')));
        else {
            if (empty($post['email']) || empty($post['password']))
                $this->redirect('/signin', array('alert' => array('message' => 'Veuillez remplir tous les champs.', 'type' => 'red')));
            else { /* authentifier ou non ici */
                $this->redirect('/signin', array('alert' => array('message' => 'Identifiants incorrects.', 'type' => 'red')));
            }
        }
        return 'ok';
    }
}

?>