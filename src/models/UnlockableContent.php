<?php

final class UnlockableContent extends Model
{
    private $id;
    private $name;
    private $description;
    private $points_required;
    private $event_id;
    private $created_at;
    private $updated_at;

    public function __construct($id, $name, $description, $event_id, $points_required, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->points_required = $points_required;
        $this->event_id = $event_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function findAll($limit = -1): array
    {
        $sql = 'SELECT  * FROM unlockable_content ORDER BY id DESC ' . ($limit > 0 ? 'LIMIT ' . $limit : '');
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $unlockableContents = [];
        foreach ($rows as $row) {
            $unlockableContent = new UnlockableContent($row['id'], $row['name'], $row['description'], $row['points_required'], $row['event_id'], $row['created_at'], $row['updated_at']);
            $unlockableContents[] = $unlockableContent;
        }
        return $unlockableContents;
    }

    public static function getById($id): ?UnlockableContent
    {
        $sql = 'SELECT  * FROM unlockable_content WHERE id = :id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;
        return new UnlockableContent($row['id'], $row['name'], $row['description'], $row['points_required'], $row['event_id'], $row['created_at'], $row['updated_at']);
    }

    public static function findByEventId($event_id): array
    {
        $sql = 'SELECT  * FROM unlockable_content WHERE event_id = :event_id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $unlockableContents = [];
        foreach ($rows as $row) {
            $unlockableContent = new UnlockableContent($row['id'], $row['name'], $row['description'], $row['points_required'], $row['event_id'], $row['created_at'], $row['updated_at']);
            $unlockableContents[] = $unlockableContent;
        }
        return $unlockableContents;
    }

    public function save()
    {
        $sql = 'REPLACE INTO unlockable_content(name, description, points_required, event_id, author) VALUES (:name,:description,:points_required,:event_id,:author)';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':points_required', $this->points_required);
        $stmt->bindParam(':event_id', $this->event_id);
        $stmt->bindParam(':author', $this->author);
        $stmt->execute();
    }

    public function update()
    {
        $sql = 'UPDATE unlockable_content SET name = :name, description = :description, points_required = :points_required, event_id = :event_id, author = :author WHERE id = :id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':points_required', $this->points_required);
        $stmt->bindParam(':event_id', $this->event_id);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public function delete()
    {
        $sql = 'DELETE FROM unlockable_content WHERE id = :id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRequiredPoints(): int
    {
        return $this->points_required;
    }

    public function setRequiredPoints(int $points_required): void
    {
        $this->points_required = $points_required;
    }

    public function getEventId(): int
    {
        return $this->event_id;
    }

    public function setEventId(int $event_id): void
    {
        $this->event_id = $event_id;
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function getUpdatedAt(): DateTime
    {
        return new DateTime($this->updated_at);
    }

}