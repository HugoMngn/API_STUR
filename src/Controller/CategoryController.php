<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/api/categories/{category}', name:"api_category_getCategory")]
    public function getCategory(Category $category): JsonResponse
    {
       // On Récupèrer les infos du parent si la catégorie a un parent
        $parent = null;
        if ($category->getParent()) {
            $parent = [ 
              'id' => $category->getParent()->getId(),
              'name' => $category->getParent()->getName(),
            ];
        }

        // On récupérer les enfants de la catégorie
        $children = [];
        foreach ($category->getChildren() as $child) {
            $children[] = [
                'id' => $child->getId(),
                'name' => $child->getName(),
            ];
        }

        // Sérialiser l'objet Category et les enfants en JSON
        $data = [
            'id' => $category->getId(),
            'name' => $category->getName(),
            'parent' => $parent,
            'children' => $children,
        ];

        // Retourner la réponse JSON
        return new JsonResponse($data);
    }
/*
    #[Route('/api/category', name: 'put_category')]

    #[Route('/api/category/{categoryId}', name: 'del_category')]

    #[Route('/api/category/{categoryId}', name: 'get_category')]
*/
}
