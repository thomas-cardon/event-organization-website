<?php
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'e-event.io');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_CHARSET', 'utf8');
    define('DB_COLLATE', '');
class Model {
    protected static $db = null;

    /**
     * Gets the database connection
     * Shares instance between all models
     * @author Thomas Cardon
     * @return PDO
     */
    public function __construct() {
        self::getDatabaseInstance();
    }

    public function conn() {
        return self::$db;
    }

    public static function getDatabaseInstance() {
        if (self::$db === null) {
            self::$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$db;
    }

    public function __destruct() {
        self::$db = null;
    }

    public function getUserRole(){
        $id = $_SESSION['user'];
        $req = $this->conn()->query("SELECT role FROM user WHERE `id`='".$id."'");
        return $req;
    }
}