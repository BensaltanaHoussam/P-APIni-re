<?php

namespace App\Repositories;

use App\Models\Plant;
use App\Repositories\Interface\PlantRepositoryInterface;

class PlantRepository implements PlantRepositoryInterface
{
    public function getAllPlants()
    {
        return Plant::with('category')->get();
    }

    public function deletePlant($plantId)
    {
        Plant::destroy($plantId);
    }

    public function createPlant(array $plantDetails)
    {
        return Plant::create($plantDetails);
    }

    public function updatePlant($plantId, array $newDetails)
    {
        return Plant::whereId($plantId)->update($newDetails);
    }

    public function getPlantBySlug($slug)
    {
        return Plant::with('category')->where('slug', $slug)->firstOrFail();
    }


}