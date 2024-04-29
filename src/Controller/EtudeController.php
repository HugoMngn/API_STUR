<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EtudeController extends AbstractController
{
    #[Route('/etude', name: 'app_etude')]
    public function index(): Response
    {
        return $this->render('etude/index.html.twig', [
            'controller_name' => 'EtudeController',
        ]);
    }
}
