<?php

class DBRepository implements GardenRepository {

    private PDO $pdo;

    public function __construct() {
        $host = '127.0.0.1';
        $db   = 'garden';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        $this->pdo = new PDO($dsn, $user, $pass, $options);
    }

    public function save(Darzove $darzove) {
        if ($darzove instanceof Agurkas) {
            $type = 'agurkas'; 
        } else if ($darzove instanceof Pomidoras) {
            $type = 'pomidoras';
        }
        
        $sql = "INSERT INTO `veggies` (`amount`, `type`)
        VALUES (".$darzove->getKiekis(). ", '".$type."');";
        $this->pdo->query($sql);
    }

    
    public function get(int $id) {
        $sql = "SELECT * FROM `veggies`
        WHERE `id` = ".$id.";";
        $stmt = $this->pdo->query($sql); 

        $masyvas = [];
        while ($row = $stmt->fetch())
        {
            $masyvas[] = $row;
        }
        if ($masyvas['type'] === 'agurkas') {
            $agurkas = new Agurkas($id);
            $agurkas->setKiekis($masyvas['amount']);
            return $agurkas;
        } else if ($masyvas['type'] === 'pomidoras') {
            $pomidoras = new Pomidoras($id);
            $pomidoras->setKiekis($masyvas['amount']);
            return $pomidoras;
        }
    }

    public function getNewId() {
        return 0;
    }

    public function getAll() {
        $sql = "SELECT * FROM `veggies`;";
        $stmt = $this->pdo->query($sql); 
        $arr = [];
        while ($row = $stmt->fetch())
        {
            if ($row['type'] === 'agurkas') {
                $agurkas = new Agurkas($row['id']);
                $agurkas->setKiekis($row['amount']);
                $arr[] = $agurkas;
            } else if ($row['type'] === 'pomidoras') {
                $pomidoras = new Pomidoras($row['id']);
                $pomidoras->setKiekis($row['amount']);
                $arr[] = $pomidoras;
            }
        }   
        return $arr;
    }

    public function getAllByType($type) {
        $sql = "SELECT * FROM `veggies` WHERE `type` = '".$type."';";
        $stmt = $this->pdo->query($sql); 
        $arr = [];
        while ($row = $stmt->fetch())
        {
            if ($row['type'] === 'agurkas') {
                $agurkas = new Agurkas($row['id']);
                $agurkas->setKiekis($row['amount']);
                $arr[] = $agurkas;
            } else if ($row['type'] === 'pomidoras') {
                $pomidoras = new Pomidoras($row['id']);
                $pomidoras->setKiekis($row['amount']);
                $arr[] = $pomidoras;
            }
        }   
        return $arr;
    }
    
    public function delete(int $id) {
        $sql = "DELETE FROM `veggies` WHERE `id` = ".$id.";";
        $this->pdo->query($sql);
    }

    public function update(Darzove $darzove) {
        $sql = "UPDATE `veggies`
        SET `amount` = ".$darzove->getKiekis()." 
        WHERE `id`=".$darzove->getId().";";
        $this->pdo->query($sql);
        
    }

}