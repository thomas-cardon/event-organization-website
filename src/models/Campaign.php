<?php

final class Campaign extends Model
{
    private $id;
    private $name;
    private $description;
    private $startDate;
    private $endDate;
    private $created_at;
    private $updated_at;

    /**
     * @param $name
     * @param $description
     * @param null $id
     * @param null $created_at
     * @param null $updated_at
     */
    public function __construct($name, $description, $startDate, $endDate, $id = null, $created_at = null, $updated_at = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function find($limit = -1, $offset = 0)
    {
        $sql = 'SELECT * FROM campaign DESC ' . ($limit > 0 ? 'LIMIT ' . $limit : '') . ($offset > 0 ? ' OFFSET ' . $offset : '');
        $stmt = self::getDatabaseInstance()->prepare($sql);

        if ($limit > 0) {
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        if ($offset > 0) {
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        }

        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $campaigns = [];
        foreach ($rows as $row) {
            $campaign = new Campaign($row['name'], $row['description'], $row['startDate'], $row['endDate'], $row['id'], $row['created_at'], $row['updated_at']);
            $campaigns[] = $campaign;
        }
        return $campaigns;
    }

    /**
     * findOverCampaigns
     * Retourne les campagnes qui sont terminées et qui ne sont plus dans la phase de vote
     * @param int $limit : nombre de résultats à retourner
     * @param int $offset : nombre de résultats à ignorer
     * @return array
     */
    public static function findOverCampaigns($limit = -1, $offset = 0): array
    {
        $sql = "SELECT * FROM campaigns WHERE DATE_ADD(DATE(endDate), INTERVAL 1 DAY) <= DATE(NOW()) ORDER BY endDate DESC " . ($limit > 0 ? 'LIMIT ' . $limit : '') . ($offset > 0 ? ' OFFSET ' . $offset : '');
        $stmt = self::getDatabaseInstance()->prepare($sql);

        if ($limit > 0) {
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        if ($offset > 0) {
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        }

        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $campaigns = [];
        foreach ($rows as $row) {
            $campaign = new Campaign($row['name'], $row['description'], $row['startDate'], $row['endDate'], $row['id'], $row['created_at'], $row['updated_at']);
            $campaigns[] = $campaign;
        }
        return $campaigns;
    }

    /*
     * getCurrentCampaign()
     * Retourne la campagne en cours
     * @return Campaign
     */
    public static function getCurrentCampaign(): ?Campaign
    {
        $sql = "SELECT * FROM `campaigns` WHERE DATE(`startDate`) <= NOW() AND DATE(`endDate`) >= NOW();";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Campaign($row['name'], $row['description'], $row['startDate'], $row['endDate'], $row['id'], $row['created_at'], $row['updated_at']);
        }
        return null;
    }

    /**
     * getPendingForVoteCampaign
     * Retourne la campagne en phase de vote, si il y en a une
     * @return Campaign | null
     */
    public static function getPendingForVoteCampaign(): ?Campaign
    {
        $sql = "SELECT * FROM `campaigns` WHERE DATE(`endDate`) = DATE(NOW());";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Campaign($row['name'], $row['description'], $row['startDate'], $row['endDate'], $row['id'], $row['created_at'], $row['updated_at']);
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
            return new Campaign($row['name'], $row['description'], $row['startDate'], $row['endDate'], $row['id'], $row['created_at'], $row['updated_at']);
        }
        return null;
    }

    public static function isBetween($startDate, $endDate): bool
    {
        $sql = 'SELECT * FROM campaigns WHERE DATE(startDate) <= :startDate AND DATE(endDate) >= :endDate';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return true;
        }
        return false;
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
        $sql = 'INSERT INTO campaigns (name, description, startDate, endDate) VALUES (:name, :description, :startDate, :endDate)';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':startDate', $this->startDate);
        $stmt->bindParam(':endDate', $this->endDate);
        $stmt->execute();
        $this->id = self::getDatabaseInstance()->lastInsertId();
    }
    
    public function update()
    {
        $sql = "UPDATE campaigns SET name = :name, description =: description, startDate = :startDate, endDate = :endDate WHERE id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':startDate', $this->startDate);
        $stmt->bindParam(':endDate', $this->endDate);
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

    public function getStartDate(): DateTime
    {
        return new DateTime($this->startDate);
    }

    public function getEndDate(): DateTime
    {
        return new DateTime($this->endDate);
    }

    public function getStartDateUnformatted(): string {
        return $this->startDate;
    }

    public function getEndDateUnformatted(): string {
        return $this->endDate;
    }

    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }
}