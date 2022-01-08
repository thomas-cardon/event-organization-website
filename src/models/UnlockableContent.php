<?php

final class UnlockableContent extends Model
{
    private $id;
    private $name;
    private $description;
    private $points_required;
    private $event;
    private $author;
    private $created_at;
    private $updated_at;

    public function __construct($id, $name, $description, $points_required, $event, $author, $created_at, $updated_at)
    {
        parent::__construct();

        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->points_required = $points_required;
        $this->event = $event;
        $this->author = $author;
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
            $unlockableContent = new UnlockableContent($row['id'], $row['name'], $row['description'], $row['points_required'], $row['event'], $row['author'], $row['created_at'], $row['updated_at']);
            $unlockableContents[] = $unlockableContent;
        }
        return $unlockableContents;
    }

    public static function findById($id): UnlockableContent
    {
        $sql = 'SELECT  * FROM unlockable_content WHERE id = :id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $unlockableContent = new UnlockableContent($row['id'], $row['name'], $row['description'], $row['points_required'], $row['event'], $row['author'], $row['created_at'], $row['updated_at']);
        return $unlockableContent;
    }

    public static function findByEvent($event): array
    {
        $sql = 'SELECT  * FROM unlockable_content WHERE event = :event';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':event', $event);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $unlockableContents = [];
        foreach ($rows as $row) {
            $unlockableContent = new UnlockableContent($row['id'], $row['name'], $row['description'], $row['points_required'], $row['event'], $row['author'], $row['created_at'], $row['updated_at']);
            $unlockableContents[] = $unlockableContent;
        }
        return $unlockableContents;
    }
}