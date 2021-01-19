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
        
        $sql = "INSERT INTO `veggies` 
        VALUES (".$darzove->getKiekis(). ", ".$type.");";
        $this->pdo->query($sql);
    }

    
    public function get(int $id) {
        $sql = "SELECT * FROM `veggies`
        WHERE `id` = ".$id.";";
        $stmt = $pdo->query($sql); 

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
        
    }

    public function getAllByType($type);
    
    public function delete(int $id);

}