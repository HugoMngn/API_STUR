<?php

namespace App\Controller;

use App\Service\CategoryJsonFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
        try {
            $categoryData = $this->categoryJsonFormatter->getCategoryDetails($categoryId);

            if (!$categoryData) {
                return new JsonResponse(
                    ['error' => 'Category not found'], 
                    Response::HTTP_NOT_FOUND
                );
            }

            return new JsonResponse($categoryData, Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(
                ['error' => 'An error occurred: ' . $e->getMessage()], 
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    #[Route('/api/categories', name: 'api_category_createCategory', methods:['POST'])]
    public function createCategory(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);
        $newCategoryData = $this->categoryJsonFormatter->createCategory($requestData);
        return new JsonResponse($newCategoryData, Response::HTTP_CREATED);

        // return new JsonResponse(['message' => 'Create category endpoint reached'], Response::HTTP_OK);
    }

    #[Route('/api/categories/{categoryId}', name: 'api_category_updateCategory', methods:['PUT'])]
    public function updateCategory(int $categoryId, Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);
        $updatedCategoryData = $this->categoryJsonFormatter->updateCategory($categoryId, $requestData);
        return new JsonResponse($updatedCategoryData, Response::HTTP_OK);

        // return new JsonResponse(['message' => 'Update category endpoint reached'], Response::HTTP_OK);
    }

    #[Route('/api/categories/{categoryId}', name: 'api_category_deleteCategory', methods:['DELETE'])]
    public function deleteCategory(int $categoryId): JsonResponse
    {
        $this->categoryJsonFormatter->deleteCategory($categoryId);
        return new JsonResponse(['message' => 'Category deleted successfully'], Response::HTTP_OK);

        // return new JsonResponse(['message' => 'Delete category endpoint reached'], Response::HTTP_OK);
    }
}
