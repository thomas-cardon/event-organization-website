<?php
final class Event extends Model
{
    private $id;
    private $name;
    private $description;

    private $author;

    private $status = 'pending';

    private $startDate;
    private $endDate;

    private $created_at;
    private $updated_at;

    public function __construct(string $name, string $description, int $author, string $startDate, string $endDate, ?string $created_at = null, ?string $updated_at = null, ?string $status = null, ?int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->author = $author;
        $this->status = $status ?? 'pending';
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->created_at = $created_at ?? date('Y-m-d H:i:s');
        $this->updated_at = $updated_at ?? date('Y-m-d H:i:s');
    }

    public static function getById($id): ?Event
    {
        $sql = 'SELECT * FROM events WHERE id = :id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;
        return new Event($row['name'], $row['description'], $row['author'], $row['startDate'], $row['endDate'], $row['created_at'], $row['updated_at'], $row['status'], $row['id']);
    }

    public static function findAll($limit = -1, $offset = 0): array
    {
        $sql = 'SELECT * FROM events ORDER BY id DESC ' . ($limit > 0 ? 'LIMIT ' . $limit : '') . ($offset > 0 ? ' OFFSET ' . $offset : '');
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $events = [];
        foreach ($rows as $row) {
            $event = new Event($row['name'], $row['description'], $row['author'], $row['startDate'], $row['endDate'], $row['created_at'], $row['updated_at'], $row['status'], $row['id']);
            $events[] = $event;
        }
        return $events;
    }

    public static function findByAuthor($author): array
    {
        $sql = 'SELECT * FROM events WHERE author = :author';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':author', $author);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $events = [];
        foreach ($rows as $row) {
            $event = new Event($row['name'], $row['description'], $row['author'], $row['startDate'], $row['endDate'], $row['created_at'], $row['updated_at'], $row['status'], $row['id']);
            $events[] = $event;
        }
        return $events;
    }

    public static function findByCampaign($campaign): array
    {        
        $sql = "SELECT * FROM events WHERE DATE(`startDate`) <= :startDate AND DATE(`endDate`) >= :endDate";
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $events = [];
        foreach ($rows as $row) {
            $event = new Event($row['name'], $row['description'], $row['author'], $row['startDate'], $row['endDate'], $row['created_at'], $row['updated_at'], $row['status'], $row['id']);
            $events[] = $event;
        }

        return $events;
    }

    public static function nbCountPerAuthor(): array
    {
        $sql = 'SELECT COUNT(*) as nb, author FROM events GROUP BY author';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public static function sumEvents(): int
    {
        $sql = 'SELECT SUM(points) as sum FROM event';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $row['sum'];
    }

    public static function sumPendingEvents(): int
    {
        $sql = 'SELECT SUM(points) as sum FROM events WHERE status = "pending" AND created_at > :campaign_start AND created_at < :campaign_end';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':campaign_start', $campaign_start);
        $stmt->bindParam(':campaign_end', $campaign_end);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $row['sum'];
    }

    public static function sumAcceptedEvents(): int
    {
        $sql = 'SELECT SUM(points) as sum FROM events WHERE status = "accepted" AND created_at > :campaign_start AND created_at < :campaign_end';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':campaign_start', $campaign_start);
        $stmt->bindParam(':campaign_end', $campaign_end);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $row['sum'];
    }

    public static function sumRejectedEvents(): int
    {
        $sql = 'SELECT SUM(points) as sum FROM events WHERE status = "rejected" AND created_at > :campaign_start AND created_at < :campaign_end';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':campaign_start', $campaign_start);
        $stmt->bindParam(':campaign_end', $campaign_end);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $row['sum'];
    }

    public static function findByStatus($status): array
    {
        $sql = 'SELECT * FROM events WHERE status = :status';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $events = [];
        foreach ($rows as $row) {
            $event = new Event($row['name'], $row['description'], $row['author'], $row['startDate'], $row['endDate'], $row['created_at'], $row['updated_at'], $row['status'], $row['id']);
            $events[] = $event;
        }
        return $events;
    }

    public static function findByStatusAndAuthor($status, $author): array
    {
        $sql = 'SELECT * FROM events WHERE status = :status AND author = :author';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':author', $author);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $events = [];
        foreach ($rows as $row) {
            $event = new Event($row['name'], $row['description'], $row['author'], $row['startDate'], $row['endDate'], $row['created_at'], $row['updated_at'], $row['status'], $row['id']);
            $events[] = $event;
        }
        return $events;
    }

    public function save(): void
    {
        $sql = 'REPLACE INTO events (name, description, author, status, `startDate`, `endDate`, created_at, updated_at) VALUES (:name, :description, :author, :status, :startDate, :endDate, :created_at, :updated_at)';
        $query = self::getDatabaseInstance();
        $stmt = $query->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':startDate', $this->startDate);
        $stmt->bindParam(':endDate', $this->endDate);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->execute();
    }

    public function update(): void
    {
        $sql = 'UPDATE events SET name = :name, description = :description, author = :author, status = :status, startDate = :startDate, to = :endDate, updated_at = :updated_at WHERE id = :id';
        $stmt = self::getDatabaseInstance();
        $stmt->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':startDate', $this->startDate);
        $stmt->bindParam(':endDate', $this->endDate);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->execute();
    }

    public function delete(): void
    {
        $sql = 'DELETE FROM events WHERE id = :id';
        $stmt = self::getDatabaseInstance();
        $stmt->prepare($sql);
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAuthorId(): int
    {
        return $this->author;
    }

    public function getAuthor(): User
    {
        return User::getById($this->author);
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getStartDate(): DateTime
    {
        return new DateTime($this->startDate);
    }

    public function getEndDate(): DateTime
    {
        return new DateTime($this->endDate);
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function getUpdatedAt(): DateTime
    {
        return new DateTime($this->updated_at);
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setAuthorId(int $author): void
    {
        $this->author = $author;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getVotes() {
        return $this->vote ?? 0;
    }

    public function setVotes($vote) {
        $this->vote = $vote;
    }

    public function getPointsAmount(): int
    {
        $sql = 'SELECT SUM(amount) as sum FROM transactions WHERE event_id = :id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $row['sum'];
    }

    public function findUnlockableContent(): array
    {
        $sql = 'SELECT * FROM events_unlockablecontent WHERE event_id = :id';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $unlockableContent = [];
        foreach ($rows as $row) {
            $unlockableContent[] = new UnlockableContent($row['id'], $row['name'], $row['description'], $row['event_id'], $row['points_required'], $row['created_at'], $row['updated_at']);
        }
        return $unlockableContent;
    }

    public function getCampaign(): Campaign
    {
        $sql = 'SELECT * FROM campaigns WHERE id = (SELECT id FROM campaigns WHERE startDate <= :startDate AND endDate >= :endDate)';
        $stmt = self::getDatabaseInstance()->prepare($sql);
        $stmt->bindParam(':startDate', $this->startDate);
        $stmt->bindParam(':endDate', $this->endDate);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Campaign($row['id'], $row['name'], $row['description'], $row['startDate'], $row['endDate'], $row['created_at'], $row['updated_at']);
    }
}