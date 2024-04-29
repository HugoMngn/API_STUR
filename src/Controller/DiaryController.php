<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DiaryController extends AbstractController
{
    #[Route('/diaries', name: 'app_diary')]
    public function index(): Response
    {
        return $this->render('diary/index.html.twig', [
            'controller_name' => 'DiaryController',
        ]);
    }
/*
    #[Route('/api/diaries/{diary_id}', name: 'put_diary')]
    
    #[Route('/api/diaries/{diary_id}', name: 'del_diary')]

    #[Route('/api/diaries/{diary_id}', name: 'get_diary')]

*/
}
