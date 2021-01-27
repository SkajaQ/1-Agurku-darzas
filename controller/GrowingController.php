<?php

use Symfony\Component\HttpFoundation\JsonResponse;

class GrowingController {
    
    private $repository; 
    
    public function __construct($repository) {
        $this->repository = $repository;
        header('Content-Type: application/json');
    }

    public function growAll($array) {
        foreach ($array as $index => &$item) {
            $darzove = new Agurkas($item->id);
            $darzove->setKiekis($item->amount);
            $this->repository->update($darzove);
        }
    }

}