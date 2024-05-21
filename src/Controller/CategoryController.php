<?php

namespace App\Controller;

use App\Manager\CategoryManager;
use App\Service\CategoryJsonFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    private $categoryJsonFormatter;
    private $categoryManager;

    public function __construct(CategoryJsonFormatter $categoryJsonFormatter, CategoryManager $categoryManager) 
    {
        $this->categoryJsonFormatter = $categoryJsonFormatter;
        $this->categoryManager = $categoryManager;
    }

    #[Route("/api/category/{categoryId}", name:"api_category_getCategory", methods:['GET'])]
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

    #[Route('/api/category', name: 'api_category_createCategory', methods:['POST'])]
    public function createCategory(Request $request): JsonResponse
    {
        try {
            $requestData = json_decode($request->getContent(), true);

            $newCategory = $this->categoryManager->createCategory($requestData);

            return new JsonResponse(
                [
                    'message' => 'Category created successfully', 
                    'data' => $this->categoryJsonFormatter->getCategoryDetails($newCategory->getId())
                ],
                Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse(
                ['error' => 'An error occurred: ' . $e->getMessage()], 
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    
    #[Route('/api/category/{categoryId}', name: 'api_category_updateCategory', methods:['PUT'])]
    public function updateCategory(int $categoryId, Request $request): JsonResponse
    {
        try {
            $requestData = json_decode($request->getContent(), true);

            $updatedCategory = $this->categoryManager->updateCategory($categoryId, $requestData);

            if (null === $updatedCategory) {
                return new JsonResponse(
                    ['error' => 'Category not found'], 
                    Response::HTTP_NOT_FOUND
                );
            }

            return new JsonResponse(
                [
                    'message' => 'Category updated successfully', 
                    'data' => $this->categoryJsonFormatter->getCategoryDetails($categoryId)
                ], 
                Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(
                ['error' => 'An error occurred: ' . $e->getMessage()], 
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    
    #[Route('/api/category/{categoryId}', name: 'api_category_deleteCategory', methods:['DELETE'])]
    public function deleteCategory(int $categoryId): JsonResponse
    {
        try {
            $category = $this->categoryManager->deleteCategory($categoryId);

            if (!$category) {
                return new JsonResponse(
                    ['error' => 'Category not found'], 
                    Response::HTTP_NOT_FOUND
                );
            }

            return new JsonResponse(['message' => 'Category [' . $category->getName() . '] has been successfully deleted'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(
                ['error' => 'An error occurred: ' . $e->getMessage()], 
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
