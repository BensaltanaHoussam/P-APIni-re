<?php

namespace App\Services;

use App\Repositories\Interface\PlantRepositoryInterface;
use Illuminate\Support\Str;

class PlantService
{
    private $plantRepository;

    public function __construct(PlantRepositoryInterface $plantRepository)
    {
        $this->plantRepository = $plantRepository;
    }

    public function getAllPlants()
    {
        return $this->plantRepository->getAllPlants();
    }

    public function deletePlant($plantId)
    {
        return $this->plantRepository->deletePlant($plantId);
    }

    public function createPlant(array $plantDetails)
    {
        // Generate slug from name
        $plantDetails['slug'] = Str::slug($plantDetails['name']);
        return $this->plantRepository->createPlant($plantDetails);
    }

    public function updatePlant($plantId, array $newDetails)
    {
        if (isset($newDetails['name'])) {
            $newDetails['slug'] = Str::slug($newDetails['name']);
        }
        return $this->plantRepository->updatePlant($plantId, $newDetails);
    }

    public function getPlantBySlug($slug)
    {
        return $this->plantRepository->getPlantBySlug($slug);
    }

 

}