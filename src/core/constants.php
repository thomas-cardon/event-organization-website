<?php

// Rappel : nous sommes dans le répertoire Core, voilà pourquoi dans realpath je "remonte d'un cran" pour faire référence
// à la VRAIE racine de mon application

final class Constants
{
    // Les constantes relatives aux chemins

    const CORE_PATH       = '/core/';
    const EXCEPTIONS_PATH  = '/core/exceptions/';

    const CONTROLLERS_PATH = '/controllers/';
    const VIEWS_PATH        = '/views/';
    const MODELS_PATH      = '/models/';

    public static function root() {
        return realpath(__DIR__ . '/../');
    }

    public static function getPublicPath() {
        return BASE_PATH . '/public';
    }

    public static function getCorePath() {
        return self::root() . self::CORE_PATH;
    }

    public static function getExceptionsPath() {
        return self::root() . self::EXCEPTIONS_PATH;
    }

    public static function getViewsPath() {
        return self::root() . self::VIEWS_PATH;
    }

    public static function getModelsPath() {
        return self::root() . self::MODELS_PATH;
    }

    public static function getControllersPath() {
        return self::root() . self::CONTROLLERS_PATH;
    }


}