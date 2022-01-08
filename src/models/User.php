<?php

final class User extends Model
{
    private $id;
    private $email;
    private $firstName;
    private $lastName;
    private $hash;

    /**
     * @param mixed $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }
    private $role;
    private $created_at;
    private $updated_at;
    private $points;


    public function __construct($email, $firstName, $lastName, $hash, $points = 0, $id = null, $role = null, $created_at = null, $updated_at = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->hash = $hash;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->role = $role;
        $this->points= $points;
    }

    public static function findAll(): array
    {
        $sql = 'SELECT  * FROM users';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];
        foreach ($rows as $row) {
            $user = new User($row['email'], $row['first_name'], $row['last_name'], $row['hash'],$row['points'],
                $row['id'], $row['role'], $row['created_at'], $row['updated_at']);
            $user[] = $user;
        }
        return $users;

    }

    public static function getById($id)
    {
        $sql = 'SELECT * FROM users WHERE id = :id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User($row['email'], $row['first_name'], $row['last_name'], $row['hash'],$row['points'],
                $row['id'], $row['role'], $row['created_at'], $row['updated_at']);
        }
        return null;
    }

    public static function getByEmail($email)
    {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User($row['email'], $row['first_name'], $row['last_name'], $row['hash'],$row['points'],
                $row['id'], $row['role'], $row['created_at'], $row['updated_at']);
        }
        return null;
    }

    public function save()
    {
        $sql = 'INSERT INTO users ( hash, email, first_name,last_name,points) 
                VALUES ( :hash, :email, :first_name,:last_name,:points)';
        $stmt = self::getDatabaseInstance()->prepare($sql);

        $stmt->bindParam(':hash', $this->hash);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':first_name', $this->firstName);
        $stmt->bindParam(':last_name', $this->lastName);
        $stmt->bindParam(':points', $this->points);

        $stmt->execute();
    }

    public function update()
    {
        $sql = 'UPDATE users 
                SET last_name = :last_name, first_name= :first_name, email = :email, role=:role, hash=:hash 
                WHERE id = :id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':last_name', $this->lastName);
        $stmt->bindParam(':first_name', $this->firstName);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':hash', $this->hash);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':points', $this->points);
        $stmt->execute();
    }

    public function delete()
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getHash() {
        return $this->hash;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    
    public function getName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }


    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return int points
     */
    public function getPoints() {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints($points) {
        $this->points = $points;
    }
}
