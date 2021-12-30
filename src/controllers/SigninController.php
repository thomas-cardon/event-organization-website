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

    private function userError($msg, $type = 'red') {
        $this->redirect('/signin', array('alert' => array('message' => $msg, 'type' => $type)));
    }

    public function authAction($params, $post, $session) {
        // On vérifie si l'utilisateur est déjà authentifié
        if ($this->isAuthentified())
            $this->redirect('/', array('alert' => array('message' => 'Vous êtes déjà connecté.', 'type' => 'blue')));
        else if (empty($post['email']) || empty($post['password']))
            $this->userError('Veuillez remplir tous les champs.');

        $this->checkCredentials($post['email'], $post['password']);
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
                $session = array(
                    'user' => $user,
                    'alert' => array('message' => 'Connexion réussie.', 'type' => 'green')
                );
                
                $_SESSION = $session;
                $this->redirect('/');
            }
            else $this->userError('Vos identifiants sont incorrects.');
        }
        else $this->userError('Aucun utilisateur avec cet identifiant existe.');
    }
}

?>