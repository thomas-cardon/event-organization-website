<?php

final class Vote extends Model
{
    private $id;
    private $user_id;
    private $campaign_id;

    public function __construct($id, $user_id, $campaign_id)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->campaign_id = $campaign_id;
    }

    public function update()
    {
        $sql = "UPDATE votes SET vote = :vote, WHERE id = :id";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':campaign_id', $this->campaign_id);
        $stmt->execute();
    }
}