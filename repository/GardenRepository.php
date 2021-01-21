<?php
interface GardenRepository {

    public function save(Darzove $darzove);
    
    public function get(int $id);

    public function getNewId();

    public function getAll();

    public function getAllByType($type);
    
    public function delete(int $id);

    public function update(Darzove $darzove);

}