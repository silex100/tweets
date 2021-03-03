<?php 

namespace App\Model;

class Tweet
{
    use \App\Database\Db;
    protected \PDO $db;
    public ?int $tweet_id = 0;
    public ?string $tweet_nom = "";
    public ?string $tweet_message = "";
    public ?string $tweet_tags ="";
    public ?string $tweet_creation="";
    /**
     * Constructor
     */
    public function __construct() {
        $this->db = self::connection();
    }
    /**
     * GET findAll
     * 
     * @return array
     */
    public function findAll(): Array
    {
        $stmt = $this->db->prepare("SELECT * FROM tweet ");
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
        $stmt->closeCursor(); 
        return $result?? [];
    }
    /**
     * GET Find
     * 
     * @param int $id - 
     * 
     * @return int
     */
    public function find(int $id): Tweet
    {
        $stmt = $this->db->prepare("SELECT * FROM tweet WHERE tweet_id = :id ");
        $stmt->bindParam(':tweet_id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchObject(__CLASS__); 
        $stmt->closeCursor();
        return is_object($result) ? $result : $this;
    }
    /**
     * GET FindByName
     * 
     * @param int $ - 
     * 
     * @return int
     */
    public function findByName(string $nom)
    {
        $stmt = $this->db->prepare("SELECT * FROM tweet WHERE tweet_nom = :tweet_nom ");
        $stmt->bindParam(':tweet_nom', $nom);
        $stmt->execute();
        $result = $stmt->fetchObject(__CLASS__); 
        $stmt->closeCursor();
        return is_object($result) ? $result : $this; 
    }
    /**
     * Delete
     * 
     * @param int $id - 
     *
     * @return $id
     */
    public function delete(int $id): bool
    {
        $pays= $this->find($id);
        if ($pays->tweet_id) {
            $sql = sprintf("DELETE FROM tweet WHERE tweet_id = %d", (int) $id);
            $this->db->exec($sql);
            return true;
        }
        return false;
    }

    /**
     * Methode save
     * 
     * @return int
     */
    public function save(): ?int
    {
        if ($this->tweet_id) {
            $sql = "UPDATE tweet SET ";
            $sql.= "tweet_nom=?, tweet_message=?, tweet_tags=?, ";
            $sql.= "tweet_creation=? WHERE tweet_id=? ";
            $stmt = $this->db->prepare($sql);
            $this->db->beginTransaction();
            $stmt->execute(
                [
                    $this->tweet_nom, $this->tweet_message,  $this->tweet_tags,  
                    $this->tweet_creation, $this->tweet_id
                ]
            );
            $this->db->commit(); 
            return $this->tweet_id;
        } else {
            $sql ="INSERT INTO tweet ";
            $sql.="(tweet_nom, tweet_message, tweet_tags, tweet_creation) ";
            $sql.="VALUES (?, ?, ?, ?)  ";
            $stmt = $this->db->prepare($sql);
            $this->db->beginTransaction();
            $stmt->execute(
                [
                    $this->tweet_nom, $this->tweet_message,  $this->tweet_tags,  
                    $this->tweet_creation
                ]
            );
            $id = $this->db->lastInsertId('tweet_id');
            $this->db->commit();
            return $id;
        }
    }
}
