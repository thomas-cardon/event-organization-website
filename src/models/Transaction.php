<?php
final class Transaction extends Model
{
    private $user_id;
    private $event_id;
    private $amount;
    private $comment;
    private $created_at;

    public function __construct($user_id, $event_id, $amount, $comment = null, $created_at = null)
    {
        $this->user_id = $user_id;
        $this->event_id = $event_id;
        $this->amount = $amount;
        $this->comment = $comment;
        $this->created_at = $created_at;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getUser()
    {
        return User::getById($this->user_id);
    }

    public function getEventId()
    {
        return $this->event_id;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setEventId($event_id)
    {
        $this->event_id = $event_id;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    private function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function save()
    {
        $sql = "INSERT INTO transactions (user_id, event_id, amount,comment) VALUES (:user_id, :event_id, :amount, :comment)";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':event_id', $this->event_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':comment', $this->comment);

        $stmt->execute();
    }

    public function delete()
    {
        $sql = "DELETE FROM transactions WHERE id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public static function find()
    {
        $sql = "SELECT * FROM transactions";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $transactions = [];
        foreach ($rows as $row) {
            $transaction = new Transaction($row['user_id'], $row['event_id'], $row['amount'], $row['comment'], $row['created_at']);
            $transactions[] = $transaction;
        }
        return $transactions;
    }

    public static function findByUserId($user_id)
    {
        $sql = "SELECT * FROM transactions WHERE user_id = :user_id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $transactions = [];
        foreach ($rows as $row) {
            $transaction = new Transaction($row['user_id'], $row['event_id'], $row['amount'], $row['comment'], $row['created_at']);
            $transactions[] = $transaction;
        }
        return $transactions;
    }

    public static function findByEventId($event_id): array
    {
        $sql = "SELECT * FROM transactions WHERE event_id = :event_id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $transactions = [];
        foreach ($rows as $row) {
            $transaction = new Transaction($row['user_id'], $row['event_id'], $row['amount'], $row['comment'], $row['created_at']);
            $transactions[] = $transaction;
        }
        return $transactions;
    }
}