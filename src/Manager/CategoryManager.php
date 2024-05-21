<?php

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;

class CategoryManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createCategory(array $data): ?Category
    {
        $category = new Category();
        $category->setName($data['name']);

        // If parent category ID is provided, assign parent
        if (isset($data['parent_id'])) {
            $parent = $this->entityManager->getRepository(Category::class)->find($data['parent_id']);
            if ($parent) {
                $category->setParent($parent);
            }
        }

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        return $category;
    }

    
    public function updateCategory(int $categoryId, array $data): ?Category
    {
        $category = $this->entityManager->getRepository(Category::class)->find($categoryId);

        if (!$category) {
            return null;
        }

        $category->setName($data['name']);

        // If parent category ID is provided, assign parent
        if (isset($data['parent_id'])) {
            $parent = $this->entityManager->getRepository(Category::class)->find($data['parent_id']);
            if ($parent) {
                $category->setParent($parent);
            } else {
                $category->setParent(null); // Unassign parent if invalid ID provided
            }
        } else {
            $category->setParent(null); // Unassign parent if no ID provided
        }

        $this->entityManager->flush();

        return $category;
    }

    public function deleteCategory(int $categoryId): mixed
    {
        $category = $this->entityManager->getRepository(Category::class)->find($categoryId);
  
        if (!$category) {
            return false;
        }

        $this->entityManager->remove($category);
        $this->entityManager->flush();

        return $category;
    }
}