<?php

namespace App\Http\Controllers;

use App\Services\PlantService;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class PlantController extends Controller
{
    private $plantService;

    public function __construct(PlantService $plantService)
    {
        $this->plantService = $plantService;
    }

    public function index(){
        $plants = $this->plantService->getAllPlants();
        return response()->json($plants);
    }

    public function store(Request $request){
        $plantDetails = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|string',
            'category_id' => 'required',
        ]);
        $plant =$this->plantService->createPlant($plantDetails);
        return response()->json($plant, 201);
    }


    public function update(Request $request, $id)
    {
        $plantDetails = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $plant = $this->plantService->updatePlant($id, $plantDetails);
        return response()->json($plant);
    }


    public function destroy($id)
    {
        $this->plantService->deletePlant($id);
        return response()->json(null, 204);
    }


    public function showBySlug($slug)
    {
        $plant = $this->plantService->getPlantBySlug($slug);
        return response()->json($plant);
    }
}
