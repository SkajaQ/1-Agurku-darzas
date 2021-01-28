<?php

use Symfony\Component\HttpFoundation\JsonResponse;

class HarvestingController {

    private $repository; 
    
    public function __construct($repository) {
        $this->repository = $repository;
        header('Content-Type: application/json');
    }
 
    public function harvest($object) {
        $darzove = new Agurkas($object->id);
        $darzove->setKiekis($object->toHarvest);
        $this->repository->update($darzove);
    }

    public function harvestBush($id) {
        $darzove = new Agurkas($id);
        $darzove->setKiekis(0);
        $this->repository->update($darzove);
    }

    public function harvestAll() {
        $arr = $this->repository->getAll();
        foreach ($arr as $index => &$darzove) {
            $darzove->setKiekis(0);
            $this->repository->update($darzove);
        }
    }

}