<?php

class Agurkas extends Darzove {
    public const PRICE = 1.25;
    public function auginti() {
        return rand(2, 9);
    }

    public function getPrice() {
        return $this->getKiekis()*self::PRICE;
    }

}