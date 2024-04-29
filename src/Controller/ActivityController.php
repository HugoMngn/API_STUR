<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ActivityController extends AbstractController
{
    #[Route('/api/activity', name: 'app_activity')]
    public function index(): Response
    {
        return $this->render('activity/index.html.twig', [
            'controller_name' => 'ActivityController',
        ]);
    }
/*
    #[Route('/api/activity/{activity_id}', name: 'put_activity')]

    #[Route('/api/activity/{activity_id}', name: 'del_activity')]
    
    #[Route('/api/activity/{activity_id}', name: 'get_activity')]
    
    #[Route('/api/activities?user_id=&activity_type_id=&category_id=&pseudonym=&date>=&date<= (etc.)', name: 'get_activity_full')]
*/
}
