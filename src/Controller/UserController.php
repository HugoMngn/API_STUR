<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/api/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
/* 
    #[Route('/api/user', name: 'post_user')]

    #[Route('/api/user', name: 'put_user')]

    #[Route('/api/user', name: 'del_user')]

    #[Route('/api/user', name: 'del_user')]

    #[Route('/api/user', name: 'get_user')]

    #[Route('/api/user', name: 'gzt_user')]
*/
}
