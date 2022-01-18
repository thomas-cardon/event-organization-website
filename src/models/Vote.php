<?php

final class Vote extends Model
{
    private $id;
    private $eventId;
    private $userId;

    public function __construct($eventId, $userId, $id = null)
    {
        $this->eventId = $eventId;
        $this->userId = $userId;
        $this->id = $id;
    }

    public static function hasVoted($eventId, $userId): bool
    {
        $sql = 'SELECT * FROM votes WHERE event_id = :event_id AND user_id = :user_id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':event_id', $eventId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row !== false;
    }
    
    public static function getVotesForEvent($eventId): array
    {
        $sql = 'SELECT * FROM votes WHERE event_id = :event_id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':event_id', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getVotesForUser($userId): array
    {
        $sql = 'SELECT * FROM votes WHERE user_id = :user_id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(): bool
    {
        $sql = 'REPLACE INTO votes (event_id, user_id) VALUES (:event_id, :user_id)';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':event_id', $this->eventId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $this->userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete(): bool
    {
        $sql = 'DELETE FROM votes WHERE event_id = :event_id AND user_id = :user_id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':event_id', $this->eventId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $this->userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}