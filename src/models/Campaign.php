<?php

final class Campaign extends Model
{
    private $id;
    private $name;
    private $description;
    private $created_at;
    private $updated_at;

    /**
     * @param $name
     * @param $description
     * @param null $id
     * @param null $created_at
     * @param null $updated_at
     */
    public function __construct($name, $description, $id = null, $created_at = null, $updated_at = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function findAll()
    {
        $sql = "SELECT * FROM campaigns";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $campaigns = [];
        foreach ($rows as $row) {
            $campaign = new Campaign($row['name'], $row['description'], $row['id'], $row['created_at'], $row['updated_at']);
            $campaigns[] = $campaign;
        }
        return $campaigns;
    }
    public static function getById($id): ?Campaign
    {
        $sql = 'SELECT * FROM campaigns WHERE id = :id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Campaign($row['name'], $row['description'], $row['id'], $row['created_at'], $row['updated_at']);
        }
        return null;
    }

    public function save()
    {
        $sql = 'REPLACE INTO campaigns(name, description) VALUES (:name,:description)';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->execute();
    }

    public function update()
    {
        $sql = "UPDATE campaigns SET name = :name, description =: description WHERE id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->execute();
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
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
     * @param $name
     * @param $description
     * @param $id
     */

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}