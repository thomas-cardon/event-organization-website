<?php

final class Vote extends Model
{
    private $id;
    private $user_id;
    private $campaign_id;
    private $statusVote;

    public function __construct($id, $user_id, $campaign_id, $statusVote)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->campaign_id = $campaign_id;
        $this->statusVote = $statusVote;
    }

    public function getVotePhase()
    {
        $sql = "UPDATE campaigns SET name = :name, startDate = :startDateVote, endDate = :endDateVote WHERE id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':campaign_id', $this->campaign_id);
        $stmt->bindParam(':statusVote', $this->statusVote);
        $stmt->execute();
    }

    public function update()
    {
        $sql = "UPDATE campaigns SET vote = :vote, WHERE id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $this->i
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':campaign_id', $this->campaign_id);
        $stmt->bindParam(':statusVote', $this->statusVote);
        $stmt->execute();
    }

    public static function getPendingVote(): ?Vote
    {
        $sql = "SELECT * FROM `votes` WHERE DATE(`endDateVote`) = DATE(NOW());";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Campaign($row['name'],);
        }
        return null;
    }
}