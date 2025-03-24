<?php

namespace App\Repositories\Interface;

interface PlantRepositoryInterface
{
    public function getAllPlants();
    public function deletePlant($plantId);
    public function createPlant(array $plantDetails);
    public function updatePlant($plantId, array $newDetails);
    public function getPlantBySlug($slug);
    
}