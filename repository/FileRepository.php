<?php
class FileRepository implements GardenRepository {

    private const PATH = __DIR__.'/data/';

    private $agurkaiFile = 'agurkai';
    private $pomidoraiFile = 'pomidorai';
    private $idFile = 'lastId';
    private $agurkai;
    private $pomidorai;
    private $lastId;
    private $rawAgurkai;
    private $rawPomidorai;

    public function __construct() {
        if (!file_exists(self::PATH.$this->agurkaiFile.'.json')) {
            file_put_contents(self::PATH.$this->agurkaiFile.'.json', json_encode(['obj' => []])); // pradinis masyvas
            $this->rawAgurkai = ['obj' => []];
        }
        else {
            $this->rawAgurkai = file_get_contents(self::PATH.$this->agurkaiFile.'.json'); // nuskaitom faila
            $this->rawAgurkai = json_decode($this->rawAgurkai, 1); // paverciam masyvu
        }
        if (!file_exists(self::PATH.$this->pomidoraiFile.'.json')) {
            file_put_contents(self::PATH.$this->pomidoraiFile.'.json', json_encode(['obj' => []])); // pradinis masyvas
            $this->rawPomidorai = ['obj' => []];
        }
        else {
            $this->rawPomidorai = file_get_contents(self::PATH.$this->pomidoraiFile.'.json'); // nuskaitom faila
            $this->rawPomidorai = json_decode($this->rawPomidorai, 1); // paverciam masyvu
        }

        if (!file_exists(self::PATH.$this->idFile.'.json')) {
            file_put_contents(self::PATH.$this->idFile.'.json', json_encode(['lastId' => 0])); // pradinis masyvas
            $this->lastId = ['lastId' => 0];
        }
        else {
            $this->lastId = file_get_contents(self::PATH.$this->idFile.'.json'); // nuskaitom faila
            $this->lastId = json_decode($this->lastId, 1); // paverciam masyvu
        }

        foreach($this->rawAgurkai['obj'] as $id => &$item) {
            $this->agurkai[] = unserialize($item);
        }
        foreach($this->rawPomidorai['obj'] as $id => &$item) {
            $this->pomidorai[] = unserialize($item);
        }
    }

    public function __destruct() {
        $this->rawAgurkai['obj'] = [];
        foreach($this->agurkai as $id => $item) {
            $this->rawAgurkai['obj'][$item->getId()] = serialize($item);
        }
        $this->rawPomidorai['obj'] = [];
        foreach($this->pomidorai as $id => $item) {
            $this->rawPomidorai['obj'][$item->getId()] = serialize($item);
        }
        file_put_contents(self::PATH.$this->agurkaiFile.'.json', json_encode($this->rawAgurkai)); // viska vel issaugom faile
        file_put_contents(self::PATH.$this->pomidoraiFile.'.json', json_encode($this->rawPomidorai)); // viska vel issaugom faile
        file_put_contents(self::PATH.$this->idFile.'.json', json_encode($this->lastId)); // viska vel issaugom faile
    }
    

    public function save(Darzove $darzove) {
        if ($darzove instanceof Agurkas) {
            $this->agurkai[$darzove->getId()] = $darzove;
        } else if ($darzove instanceof Pomidoras) {
            $this->pomidorai[$darzove->getId()] = $darzove; 
        }
    }
    
    public function get(int $id) {
        foreach ($this->agurkai as $id => $item) {
            if ($item->getId() == $id) {
                return ($item);
            }
        }
        foreach ($this->pomidorai as $id => $item) {
            if ($item->getId() == $id) {
                return ($item);
            }
        }
        return null;
    }

    public function getNewId() {
        var_dump($this->lastId);
        return $this->lastId['lastId'][0]++;
    }

    public function getAll() {
        $tempArr = [];
            foreach($this->agurkai as $id => &$item) {
                $tempArr[] = ($item);
            }
            foreach($this->pomidorai as $id => &$item) {
                $tempArr[] = ($item);
            }
            return $tempArr;
    }

    public function getAllByType($type) {
        if ($type == 'agurkas') {
            $tempArr = [];
            foreach($this->agurkai as $id => &$item) {
                $tempArr[] = $item;
            }
            return $tempArr;
        }
        if ($type == 'pomidoras') {
            $tempArr = [];
            foreach($this->pomidorai as $id => &$item) {
                $tempArr[] = $item;
            }
            return $tempArr;
        }
    }
    
    public function delete(int $id) {
        foreach($this->agurkai as $id2 => &$agurkas) {
            $obj = ($agurkas);
            if ($obj->getId() == $id) {
                unset($this->agurkai[$id2]);
            }


            // if ($agurkas->getId() == $id) {
            //     unset($this->agurkai[$id]);

            // }
        }
        foreach($this->pomidorai as $id2 => &$pomidoras) {
            $obj = ($pomidoras);
            if ($obj->getId() == $id) {
                unset($this->pomidorai[$id2]);
            }

            // if ($pomidoras->getId() == $id) {
            //     unset($this->pomidorai[$id]);
            // }
        }
    }

    
}