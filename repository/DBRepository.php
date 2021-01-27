<?php

class DBRepository implements GardenRepository {

    private PDO $pdo;

    public function __construct() {
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $db   = $_ENV['DB_DATABASE'];
        $user = $_ENV['DB_USERNAME'];
        $pass = $_ENV['DB_PASSWORD'];
        $charset = $_ENV['DB_CHARSET'];

        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        $this->pdo = new PDO($dsn, $user, $pass, $options);
    }

    public function addNew($type) {        
        $sql = "INSERT INTO `veggies` (`type`)
        VALUES (:type);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array('type' => $type));
    }
    
    public function get(int $id) {
        $sql = "SELECT * FROM `veggies`
        WHERE `id` = :id;";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute(array('id' => $id));

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
        $sql = "SELECT * FROM `veggies` WHERE `type` = :type ORDER BY `id` DESC;";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute(array('type' => $type));
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
        $sql = "DELETE FROM `veggies` WHERE `id` = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array('id' => $id));
    }

    public function update(Darzove $darzove) {
        $sql = "UPDATE `veggies`
        SET `amount` = :amount WHERE `id` = :id;";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array(
                'amount' => $darzove->getKiekis(),
                'id' => $darzove->getId()
            ));
            return $stmt->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getHarvested($type) {
        // $sql = "SELECT SUM(amount) AS allAmount FROM veggies WHERE `type` = '".$type."';";
        // $stmt = $this->pdo->prepare($sql); 
        // $stmt->execute(array(
        //     'type' => $type
        // ));
        // $sum = 0;
        // while ($row = $stmt->fetch()) {
        //     var_dump($row);
        //     $sum = $row['allAmount'];
        // }
        // return $sum;
    }
}