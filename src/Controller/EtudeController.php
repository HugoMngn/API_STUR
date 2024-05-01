<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\EtudeJsonFormatter;

class EtudeController extends AbstractController
{
    private $etudeJsonFormatter;

    public function __construct(EtudeJsonFormatter $etudeJsonFormatter)
    {
        $this->etudeJsonFormatter = $etudeJsonFormatter;
    }

    #[Route('/api/etude/{id}', name: 'app_etude_show', methods: ['GET'])]
    public function getEtude(int $id): JsonResponse
    {
        $etude = $this->etudeJsonFormatter->getEtudeDetails($id);

        if (!$etude) {
            return new JsonResponse(['error' => 'Etude not found'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($etude, Response::HTTP_OK);
    }

    #[Route('/api/etude', name: 'app_etude_create', methods: ['POST'])]
    public function createEtude(Request $request): JsonResponse
    {
        $etudeData = json_decode($request->getContent(), true);

        $newEtudeData = $this->etudeJsonFormatter->createEtude($etudeData);

        return new JsonResponse($newEtudeData, Response::HTTP_CREATED);
    }

    #[Route('/api/etude/{id}', name: 'app_etude_update', methods: ['PUT'])]
    public function updateEtude(Request $request, int $id): JsonResponse
    {
        $etudeData = json_decode($request->getContent(), true);

        $updatedEtudeData = $this->etudeJsonFormatter->updateEtude($id, $etudeData);

        if (!$updatedEtudeData) {
            return new JsonResponse(['error' => 'Etude not found'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($updatedEtudeData, Response::HTTP_OK);
    }

    #[Route('/api/etude/{id}', name: 'app_etude_delete', methods: ['DELETE'])]
    public function deleteEtude(int $id): JsonResponse
    {
        $isDeleted = $this->etudeJsonFormatter->deleteEtude($id);

        if (!$isDeleted) {
            return new JsonResponse(['error' => 'Etude not found'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(['message' => 'Etude deleted successfully'], Response::HTTP_OK);
    }
}
