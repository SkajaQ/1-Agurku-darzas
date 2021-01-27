<?php

use Symfony\Component\HttpFoundation\JsonResponse;

class HarvestingController {

    private $repository; 
    
    public function __construct($repository) {
        $this->repository = $repository;
        header('Content-Type: application/json');
    }
 
    public static function harvest() {

    }

    public static function harvestBush($id) {

    }

    public static function harvestAll() {

    }

}