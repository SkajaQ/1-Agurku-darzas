<?php

class PlantingController {

    private $repository; 

    public function __construct($repository) {
        $this->repository = $repository;
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

    

}

