<?php

final class View
{   

    public static $title = 'foo';

    public function getTitle() {
        return self::$title;
    }

    public function setTitle($t) {
        self::$title = $t;
    }

    public static function openBuffer()
    {
        // On démarre le tampon de sortie, on va l'appeler "tampon principal"
        ob_start();
    }

    public static function getBufferContents()
    {
        // On retourne le contenu du tampon principal
        return ob_get_clean();
    }

    public static function show ($S_localisation, $A_parametres = array())
    {
        $S_fichier = Constants::getViewsPath() . $S_localisation . '.php';

        $A_vue = $A_parametres;
        // Démarrage d'un sous-tampon
        ob_start();
        include $S_fichier; // c'est dans ce fichier que sera utilisé A_vue, la vue est inclue dans le sous-tampon
        ob_end_flush();
    }
}