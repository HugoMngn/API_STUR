<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;

class CategoryJsonFormatter
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCategoryDetails(int $categoryId): ?array
    {
        $category = $this->entityManager->getRepository(Category::class)->find($categoryId);

        if (!$category) {
            return null;
        }

        $parent = null;
        if ($category->getParent()) {
            $parent = [ 
              'id' => $category->getParent()->getId(),
              'name' => $category->getParent()->getName(),
            ];
        }

        $children = [];
        foreach ($category->getChildren() as $child) {
            $children[] = [
                'id' => $child->getId(),
                'name' => $child->getName(),
            ];
        }
        
        return [
            'id' => $category->getId(),
            'name' => $category->getName(),
            'parent' => $parent,
            'children' => $children,
        ];
    }

    public function createCategory(array $data): ?array
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

        return $this->getCategoryDetails($category->getId());
    }

    public function updateCategory(int $categoryId, array $data): ?array
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

        return $this->getCategoryDetails($category->getId());
    }

    public function deleteCategory(int $categoryId): bool
    {
        $category = $this->entityManager->getRepository(Category::class)->find($categoryId);

        if (!$category) {
            return false;
        }

        $this->entityManager->remove($category);
        $this->entityManager->flush();

        return true;
    }
}