<?php

namespace App\Services;

use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryService
{

    private $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function getCategoryById($categoryId)
    {
        return $this->categoryRepository->getCategoryById($categoryId);

    }

    public function deleteCategory($categoryId)
    {
        return $this->categoryRepository->deleteCategory($categoryId);
    }

    public function createCategory(array $categoryDetails)
    {
        return $this->categoryRepository->createCategory($categoryDetails);
    }

    public function updateCategory($categoryId, array $newDetails)
    {
        return $this->categoryRepository->updateCategory($categoryId, $newDetails);
    }
}