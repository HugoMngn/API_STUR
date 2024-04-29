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
}