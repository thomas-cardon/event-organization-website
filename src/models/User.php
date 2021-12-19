<?php
final class User extends Model
{
    public function __construct()
    {
        echo 'The model has been initiated';
        parent::__construct();
    }

    private $id;
    private $username;
    private $password;
    private $email;
    private $first_name;
    private $last_name;

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }
    
    /* PDO methods */
    public static function ensureExists() {
        $table = 'users';
        $sql = "CREATE TABLE IF NOT EXISTS $table (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(20) NOT NULL,
            password VARCHAR(64) NOT NULL,
            last_name VARCHAR(20) NOT NULL,
            first_name VARCHAR(20) NOT NULL,
            email VARCHAR(50) NOT NULL
        )";

        self::getDatabaseInstance()->query($sql);
    }

    public static function getUser($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function getUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function createUser($data)
    {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $data['password'], PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function updateUser($data)
    {
        $sql = "UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $data['password'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $data['id'], PDO::PARAM_INT);
        $stmt->execute();
    }
}