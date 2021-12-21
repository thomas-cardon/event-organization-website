<?php

require dirname(__FILE__) . '/constants.php';
//require dirname(__FILE__) . '/../../config/config.php';
//require dirname(__FILE__) . '/../../config/sql.php';

final class AutoLoad
{
    public static function chargerClassesNoyau ($S_nomDeClasse)
    {
        $S_fichier = Constants::getCorePath() . "$S_nomDeClasse.php";
        return static::_charger($S_fichier);
    }

    public static function chargerClassesException ($S_nomDeClasse)
    {
        $S_fichier = Constants::getExceptionsPath() . "$S_nomDeClasse.php";

        return static::_charger($S_fichier);
    }

    public static function chargerClassesModele ($S_nomDeClasse)
    {
        $S_fichier = Constants::getModelsPath() . "$S_nomDeClasse.php";

        return static::_charger($S_fichier);
    }

    public static function chargerClassesVue ($S_nomDeClasse)
    {
        $S_fichier = Constants::getViewsPath() . "$S_nomDeClasse.php";

        return static::_charger($S_fichier);
    }

    public static function chargerClassesControleur ($S_nomDeClasse)
    {
        $S_fichier = Constants::getControllersPath() . "$S_nomDeClasse.php";

        return static::_charger($S_fichier);
    }

    private static function _charger ($S_fichierACharger)
    {
        if (is_readable($S_fichierACharger))
        {
            require $S_fichierACharger;
        }
    }
}

// J'empile tout ce beau monde comme j'ai toujours appris à le faire...

spl_autoload_register('AutoLoad::chargerClassesNoyau');
spl_autoload_register('AutoLoad::chargerClassesException');
spl_autoload_register('AutoLoad::chargerClassesModele');
spl_autoload_register('AutoLoad::chargerClassesVue');
spl_autoload_register('AutoLoad::chargerClassesControleur');
