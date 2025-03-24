<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }


    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $categoryDetails = $request->validate([
            'name' => 'required',
        ]);

        $category = $this->categoryService->createCategory($categoryDetails);
        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $categoryDetails = $request->validate([
            'name' => 'required',
        ]);

        $category = $this->categoryService->updateCategory($id, $categoryDetails);
        return response()->json($category);
    }


    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return response()->json(null, 204);
    }

}
