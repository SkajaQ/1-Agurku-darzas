<?php

class Pomidoras extends Darzove {
    public const PRICE = 1.55;
    public function auginti() {
        return rand(7, 13);
    }

    public function getPrice() {
        return $this->kiekis*self::PRICE;
    }
}