<?php

class SessionRepository implements GardenRepository {

    public function __construct() {
        if (!isset($_SESSION['agurkas'])) {
            $_SESSION['agurkas'] = [];
            $_SESSION['lastId'] = 1;
        }
        if (!isset($_SESSION['pomidoras'])) {
            $_SESSION['pomidoras'] = [];
        }
    }

    public function save(Darzove $darzove) {
    
        if ($darzove instanceof Agurkas) {
            $key = 'agurkas'; 
        } else if ($darzove instanceof Pomidoras) {
            $key = 'pomidoras';
        }
        $_SESSION[$key][$darzove->getId()] = $darzove;
    }
    
    public function get(int $id) {
        foreach ($_SESSION['agurkas'] as $id => $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }
        foreach ($_SESSION['pomidoras'] as $id => $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }
        return null;
    }

    public function getNewId() {
        return $_SESSION['lastId']++;
    }

    public function getAll() {
        return array_merge($_SESSION['agurkas'], $_SESSION['pomidoras']);
    }

    public function getAllByType($type) { 
        return $_SESSION[$type];
    }
    
    public function delete(int $id) {
        foreach($_SESSION['agurkas'] as $id2 => &$agurkas) {
            if ($agurkas->getId() == $id) {
                unset($_SESSION['agurkas'][$id]);

            }
        }
        foreach($_SESSION['pomidoras'] as $id2 => &$pomidoras) {
            if ($pomidoras->getId() == $id) {
                unset($_SESSION['pomidoras'][$id]);
            }
        }
    }

}