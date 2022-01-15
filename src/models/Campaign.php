<?php

final class Campaign extends Model
{
    private $id;
    private $name;
    private $description;
    private $from;
    private $to;
    private $created_at;
    private $updated_at;

    /**
     * @param $name
     * @param $description
     * @param null $id
     * @param null $created_at
     * @param null $updated_at
     */
    public function __construct($name, $description, $from, $to, $id = null, $created_at = null, $updated_at = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->from = $from;
        $this->to = $to;
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
            $campaign = new Campaign($row['name'], $row['description'], $row['from'], $row['to'], $row['id'], $row['created_at'], $row['updated_at']);
            $campaigns[] = $campaign;
        }
        return $campaigns;
    }

    public static function getCurrentCampaign(): ?Campaign
    {
        $sql = "SELECT * FROM `campaigns` WHERE DATE(`from`) <= NOW() AND DATE(`to`) >= NOW();";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Campaign($row['name'], $row['description'], $row['from'], $row['to'], $row['id'], $row['created_at'], $row['updated_at']);
        }
        return null;
    }
    
    public static function getById($id): ?Campaign
    {
        $sql = 'SELECT * FROM campaigns WHERE id = :id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Campaign($row['name'], $row['description'], $row['from'], $row['to'], $row['id'], $row['created_at'], $row['updated_at']);
        }
        return null;
    }

    public function countVotes(): int
    {
        $sql = "SELECT COUNT(*) FROM votes WHERE campaign_id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function hasUserVoted(User $user): bool
    {
        $sql = "SELECT COUNT(*) FROM votes WHERE campaign_id = :id AND user_id = :user_id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':user_id', $user->getId());
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
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
        $sql = "UPDATE campaigns SET name = :name, description =: description, from = :from, to = :to WHERE id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':from', $this->from);
        $stmt->bindParam(':to', $this->to);
        $stmt->execute();
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

    public function getFrom(): int {
        return strtotime($this->from);
    }

    public function setFrom($from) {
        $this->from = $from;
    }

    public function getFromUnformatted(): string {
        return $this->from;
    }

    public function getTo(): int {
        return strtotime($this->to);
    }

    public function getToUnformatted(): string {
        return $this->to;
    }

    public function setTo($to) {
        $this->to = $to;
    }
}