<?php
include __DIR__.'/Augalas.php';

class Agurkas extends Darzove implements Augalas {
    public function auginti() {
        return rand(2, 9);
    }
}