<?php
class Darzove {
    private int $id;
    private int $kiekis;

    function __construct(int $id) {
        $this->id = $id;
        $this->kiekis = 0;
    }

    public function getId() {
        return $this->id;
    }
    public function setId(int $id) {
        $this->id = $id;
    }
    public function getKiekis() {
        return $this->kiekis;
    }
    public function setKiekis(int $kiekis) {
        $this->kiekis = $kiekis;
    }

    public function auginti() {
        return 0;
    }

}

