<?php

require dirname(__FILE__) . '/constants.php';
require dirname(__FILE__) . '/../../config/config.php';
require dirname(__FILE__) . '/../../config/sql.php';

//changer nomDeClasse en className

final class AutoLoad
{
    public static function loadCoreClass ($S_className)
    {
        $S_file = Constants::getCorePath() . "$S_className.php";
        return static::_load($S_file);
    }

    public static function loadExceptionClass ($S_className)
    {
        $S_file = Constants::getExceptionsPath() . "$S_className.php";

        return static::_load($S_file);
    }

    public static function loadModeleClass ($S_className)
    {
        $S_file = Constants::getModelsPath() . "$S_className.php";

        return static::_load($S_file);
    }

    public static function loadViewClass ($S_className)
    {
        $S_file = Constants::getViewsPath() . "$S_className.php";

        return static::_load($S_file);
    }

    public static function loadControllerClass ($S_className)
    {
        $S_file = Constants::getControllersPath() . "$S_className.php";

        return static::_load($S_file);
    }

    private static function _load ($S_fileToLoad)
    {
        if (is_readable($S_fileToLoad))
        {
            require $S_fileToLoad;
        }
    }
}

// J'empile tout ce beau monde comme j'ai toujours appris à le faire...

spl_autoload_register('AutoLoad::loadCoreClass');
spl_autoload_register('AutoLoad::loadExceptionClass');
spl_autoload_register('AutoLoad::loadModeleClass');
spl_autoload_register('AutoLoad::loadViewClass');
spl_autoload_register('AutoLoad::loadControllerClass');
