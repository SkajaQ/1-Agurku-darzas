<?php

class InMemoryRepository implements GardenRepository {

    private $agurkai;
    private $pomidorai;
    private int $lastId;

    function __construct() {
        $this->agurkai = array();
        $this->pomidorai = array();
        $this->lastId = 0;
    }

    public function save(Darzove $darzove) {
        if ($darzove instanceof Agurkas) {
            $agurkai[$darzove->getId()] = $darzove; 
        } else if ($darzove instanceof Pomidoras) {
            $pomidorai[$darzove->getId()] = $darzove; 
        }
    }
    
    public function get(int $id) {
        foreach ($agurkai as $id => $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }
        foreach ($pomidorai as $id => $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }
        return null;
    }

    public function getNewId() {
        return $lastId++;
    }

    public function getAll() {
        return array_merge($agurkai, $pomidorai);
    }

    public function getAllByType($type) {
        if ($type instanceof Agurkas) {
            return $agurkai;
        }
        if ($type instanceof Pomidoras) {
            return $pomidorai;
        }
    }
    
    public function delete(int $id) {
        unset($agurkai[$id]);
        unset($pomidorai[$id]);
    }

}