<?php

namespace App\Controller;

use App\Service\CategoryJsonFormatter;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    private $categoryJsonFormatter; 

    public function __construct(CategoryJsonFormatter $categoryJsonFormatter) 
    {
        $this->categoryJsonFormatter = $categoryJsonFormatter;
    }

    #[Route("/api/categories/{categoryId}", name:"api_category_getCategory", methods:['GET'])]
    public function getCategory(int $categoryId): JsonResponse
    {
        $categoryData = $this->categoryJsonFormatter->getCategoryDetails($categoryId);

        if (!$categoryData) {
            return new JsonResponse(['error' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($categoryData);
    }
/*
    #[Route('/api/category', name: 'put_category')]

    #[Route('/api/category/{categoryId}', name: 'del_category')]

    #[Route('/api/category/{categoryId}', name: 'get_category')]
*/
}
