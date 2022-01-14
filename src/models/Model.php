<?php

class Model {

    protected static $db = null;

    /**
     * Gets the database connection
     * Shares instance between all models
     * @author Thomas Cardon
     * @return PDO
     */
    public static function getDatabaseInstance() {
        if (self::$db === null) {
            self::$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$db;
    }


}