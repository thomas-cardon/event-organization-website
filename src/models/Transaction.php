<?php
final class Transaction extends Model
{
    private $id;
    private $user_id;
    private $event_id;
    private $amount;
    private $comment;
    private $created_at;

    public function __construct($id, $user_id, $event_id, $amount, $comment, $created_at)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->event_id = $event_id;
        $this->amount = $amount;
        $this->comment = $comment;
        $this->created_at = $created_at;
    }

    public function getId()
    {
        return $this->id;
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

    public function setId($id)
    {
        $this->id = $id;
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
        $sql = "REPLACE INTO transactions (user_id, event_id, amount,comment) VALUES (:user_id, :event_id, :amount,:comment)";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':event_id', $this->event_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':comment', $this->comment);

        $stmt->execute();
    }

    public function update()
    {
        $sql = "UPDATE transactions SET user_id = :user_id, event_id = :event_id, amount = :amount, comment = :comment WHERE id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':event_id', $this->event_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':id', $this->id);
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

    public static function getById($id): ?Transaction
    {
        $sql = "SELECT * FROM transactions WHERE id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Transaction($row['id'], $row['user_id'], $row['event_id'], $row['amount'], $row['comment'], $row['created_at']);
        }
        return null;
    }

    public static function find()
    {
        $sql = "SELECT * FROM transactions";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $transactions = [];
        foreach ($rows as $row) {
            $transaction = new Transaction($row['id'], $row['user_id'], $row['event_id'], $row['amount'], $row['comment'], $row['created_at']);
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
            $transaction = new Transaction($row['id'], $row['user_id'], $row['event_id'], $row['amount'], $row['comment'], $row['created_at']);
            $transactions[] = $transaction;
        }
        return $transactions;
    }

    public static function findByEventId($event_id)
    {
        $sql = "SELECT * FROM transactions WHERE event_id = :event_id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $transactions = [];
        foreach ($rows as $row) {
            $transaction = new Transaction($row['id'], $row['user_id'], $row['event_id'], $row['amount'], $row['comment'], $row['created_at']);
            $transactions[] = $transaction;
        }
        return $transactions;
    }

    public static function getByUserIdAndEventId($user_id, $event_id)
    {
        $sql = "SELECT * FROM transactions WHERE user_id = :user_id AND event_id = :event_id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $transaction = new Transaction($row['id'], $row['user_id'], $row['event_id'], $row['amount'], $row['comment'], $row['created_at']);
            return $transaction;
        }
        return null;
    }
}