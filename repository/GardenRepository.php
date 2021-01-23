<?php
interface GardenRepository {

    public function addNew($type);
    
    public function get(int $id);

    public function getNewId();

    public function getAll();

    public function getAllByType($type);
    
    public function delete(int $id);

    public function update(Darzove $darzove);

    public function getHarvested($type);

}