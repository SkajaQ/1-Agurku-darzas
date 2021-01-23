<?php

class DBRepository implements GardenRepository {

    private PDO $pdo;

    public function __construct() {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $db   = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');
        $charset = getenv('DB_CHARSET');

        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
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
        VALUES (:amount, :type);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            'amount' => $darzove->getKiekis(),
            'type' => $type
        ));
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
        $sql = "SELECT * FROM `veggies` WHERE `type` = :type;";
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