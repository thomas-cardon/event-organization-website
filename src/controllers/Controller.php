<?php

/**
 * ControllerHelpers
 * Gives other controllers some useful methods
 * @author Thomas Cardon - https://github.com/thomas-cardon
 */
trait ControllerHelpers {
    function redirect($endpoint, $options = array()) {
        header('Location: ' . BASE_PATH . $endpoint);

        $_SESSION['alert'] = $options['alert'] ?? null;
        exit();
    }

    /**
     * isAuthentified
     * Vérifie si l'utilisateur est authentifié
     * @author : ???
     * @return Boolean
     */
    public function isAuthentified() {
        // return isset($_SESSION['user']); idées, à vous de voir? :)
        // isset: renvoie true si la variable existe, false sinon
        // $_SESSION: tableau associatif qui contient les variables de session
        return false;
    }

    public function getCurrentUser() {
        // return $_SESSION['user']; idées, à vous de voir? :)
        return null;
    }
}

final class Controller
{
    private $_url;
    private $_params;
    private $_post;

    public function __construct ($S_url)
    {
        // On élimine l'éventuel slash en fin d'URL sinon notre explode renverra une dernière entrée vide
        if ('/' == substr($S_url, -1, 1)) {
            $S_url = substr($S_url, 0, strlen($S_url) - 1);
        }

        // On éclate l'URL, elle va prendre place dans un tableau
        $url = explode('/', $S_url);

        if (empty($url[0])) {
            // Nous avons pris le parti de préfixer tous les controleurs par "Controleur"
            $url[0] = 'LandingPageController';
        } else {
            $url[0] = ucfirst($url[0]) . 'Controller';
        }

        if (empty($url[1])) {
            // L'action est vide ! On la valorise par défaut
            $url[1] = 'defaultAction';
        } else {
            // On part du principe que toutes nos actions sont suffixées par 'Action'...à nous de le rajouter
            $url[1] = $url[1] . 'Action';
        }


        // on dépile 2 fois de suite depuis le début, c'est à dire qu'on enlève de notre tableau le contrôleur et l'action
        // il ne reste donc que les éventuels parametres (si nous en avons)...
        $this->_url['controller'] = array_shift($url); // on recupere le contrôleur
        $this->_url['action']     = array_shift($url); // puis l'action

        // ...on stocke ces éventuels parametres dans la variable d'instance qui leur est réservée
        $this->_params = $url;
    }

    /* 
     * On exécute notre triplet
     */
    public function execute()
    {
        if (!class_exists($this->_url['controller'])) {
            throw new ControllerException($this->_url['controller'] . " n'est pas un contrôleur valide.");
        }

        if (!method_exists($this->_url['controller'], $this->_url['action'])) {
            throw new ControllerException($this->_url['action'] . " du contrôleur " .
                $this->_url['controller'] . " n'est pas une action valide.");
        }

        session_start();

        $B_called = call_user_func_array(array(new $this->_url['controller'],
            $this->_url['action']), array($this->_params, $_POST, $_SESSION));

        if (false === $B_called) {
            throw new ControllerException("L'action " . $this->_url['action'] .
                " du contrôleur " . $this->_url['controller'] . " a rencontré une erreur.");
        }
    }
}