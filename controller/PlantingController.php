<?php

use Symfony\Component\HttpFoundation\JsonResponse;

class PlantingController {

    private $repository; 
    
    public function __construct($repository) {
        $this->repository = $repository;
        header('Content-Type: application/json');
    }

    public function get($type) {
        $result = $this->repository->getAllByType($type);
        $response = new JsonResponse($this->map($result));
        return $response->send(); 
    }

    public function render() {
        return include_once __DIR__.'/pages/sodinimas.php';
    }

    public function plant($type) {
        $this->repository->addNew($type);
    }

    public function remove($id) {
        $this->repository->delete($id);
    }
    
    private function map($result) {
        $string = "[";
        $arr = [];
        foreach($result as $id => $darzove) {
            $arr[] = '{"id":'.$darzove->getId().',"kiekis":'.$darzove->getKiekis().'}';
        }
        $string = $string.implode($arr, ",");
        $string = $string."]";
        return $string;    
    }
}

