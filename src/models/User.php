<?php

final class User extends Model
{
    private $id;
    private $email;
    private $firstName;
    private $lastName;
    private $hash;    
    private $role;
    private $created_at;
    private $updated_at;
    private $points;
    private $avatar;

    public function __construct($email, $firstName, $lastName, $hash, $points = 0, $id = null, $role = 'donor', $created_at = null, $updated_at = null, $avatar = null)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->hash = $hash;
        $this->role = $role;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->points = $points;
        $this->avatar = $avatar;
    }

    public static function find($limit = -1): array
    {
        $sql = 'SELECT  * FROM users ORDER BY id DESC ' . ($limit > 0 ? 'LIMIT ' . $limit : '');
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];
        foreach ($rows as $row) {
            $user = new User($row['email'], $row['first_name'], $row['last_name'], $row['hash'], $row['points'],
                $row['id'], $row['role'], $row['created_at'], $row['updated_at']);
            $users[] = $user;
        }
        return $users;

    }

    public static function nbCountPerRole(): array
    {
        $sql = 'SELECT COUNT(*) as nb, role FROM users GROUP BY role';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public static function sumPoints(): int
    {
        $sql = 'SELECT SUM(points) as sum FROM users';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $row['sum'];
    }

    public static function getById($id): ?User
    {
        $sql = 'SELECT * FROM users WHERE id = :id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User($row['email'], $row['first_name'], $row['last_name'], $row['hash'], $row['points'],
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
            return new User($row['email'], $row['first_name'], $row['last_name'], $row['hash'], $row['points'],
                $row['id'], $row['role'], $row['created_at'], $row['updated_at']);
        }
        
        return null;
    }

    /**
     * Création d'un utilisateur dans la base de donnée
     * @return void
     */
    public function save()
    {
        $sql = 'REPLACE INTO users (id, hash, email, first_name, last_name, points, role, created_at, updated_at, avatar)
        VALUES (:id, :hash, :email, :first_name, :last_name, :points, :role, :created_at, :updated_at, :avatar)';

        $stmt = self::getDatabaseInstance()->prepare($sql);

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':hash', $this->hash);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':first_name', $this->firstName);
        $stmt->bindParam(':last_name', $this->lastName);
        $stmt->bindParam(':points', $this->points);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->bindParam(':avatar', $this->avatar);

        $stmt->execute();
    }

    /**
     * Modification d'un utilisateur dans la base de donnée
     * @return void
     */
    public function update()
    {
        $sql = 'UPDATE users 
                SET last_name = :last_name, first_name = :first_name, email = :email, role = :role, hash = :hash, points = :points, updated_at = NOW()
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

    /**
     * Suppression d'un utilisateur dans la basse de donnée
     * @return void
     */
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
     * @param mixed $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
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

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function getUpdatedAt(): DateTime
    {
        return new DateTime($this->updated_at);
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
        return $this->points ?? 0;
    }

    /**
     * @param int $points
     */
    public function setPoints($points) {
        $this->points = $points;
    }

    public function getAvatar() {
        return $this->avatar ?? 'https://www.gravatar.com/avatar/' . md5($this->email) . '?s=200';
    }
    
    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }
}
