<?php

final class View
{   

    private static $title = 'foo';
    private static $stylesheets = array();
    private static $scripts = array();

    public static function getTitle() {
        return self::$title;
    }

    public static function setTitle($t) {
        self::$title = $t;
    }

    public static function openBuffer()
    {
        // On démarre le tampon de sortie, on va l'appeler "tampon principal"
        ob_start();
    }

    public static function resetBuffer()
    {
        // On vide le tampon de sortie
        ob_clean();
    }

    public static function getBufferContents()
    {
        // On retourne le contenu du tampon principal
        return ob_get_clean();
    }

    public static function addStyleSheet($path)
    {
        self::$stylesheets[] = $path;
    }

    public static function getStyleSheets()
    {
        return self::$stylesheets;
    }

    public static function addScript($id, $path, $offline = false, $position = 'head', $async = false, $type = 'text/javascript', $integrity, $crossorigin)
    {
        self::$scripts[$position][$id] = array(
            'path' => $path,
            'type' => $type,
            'async' => $async,
            'offline' => $offline,
            'integrity' => $integrity,
            'crossorigin' => $crossorigin
        );
    }

    public static function getScripts()
    {
        return self::$scripts;
    }

    /**
     * function show
     * Permet d'afficher une vue
     * @param string $path
     * @param array params
     */
    public static function show ($path, $params = array())
    {
        $params = array_merge(array(
            'authentified' => false,
            'user' => null
            // Paramètres par défaut pour les vues
        ), $params);

        $S_fichier = Constants::getViewsPath() . $path . '.php';

        // Démarrage d'un sous-tampon
        ob_start();
        include $S_fichier;
        ob_end_flush();
    }

    /**
     * function get
     * Permet de récupérer le contenu d'un fichier de vue
     * @author Thomas Cardon
     * @param string $path
     * @param array $params
     */
    public static function get ($path, $params = array())
    {
        $params = array_merge(array(
            'authentified' => false,
            'user' => null
            // Paramètres par défaut pour les vues
        ), $params);

        $S_fichier = Constants::getViewsPath() . $path . '.php';

        // Démarrage d'un sous-tampon
        ob_start();
        include $S_fichier;
        return ob_get_clean();
    }
}