<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/api/category/{categoryId}', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository, Category $categoryId): JsonResponse
    {
        $category = $categoryRepository->findOneById($categoryId);

        return new JsonResponse($category);
    }
/*
    #[Route('/api/category', name: 'category')]

    #[Route('/api/category/{categoryId}', name: 'del_category')]

    #[Route('/api/category/{categoryId}', name: 'get_category')]
*/
}
