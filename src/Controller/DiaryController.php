<?php

namespace App\Controller;

use App\Service\DiaryJsonFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiaryController extends AbstractController
{
    private $diaryJsonFormatter;

    public function __construct(DiaryJsonFormatter $diaryJsonFormatter)
    {
        $this->diaryJsonFormatter = $diaryJsonFormatter;
    }

    // #[Route('/diaries', name: 'app_diary', methods:['GET'])]
    // public function index(): JsonResponse
    // {
    //     // Implement index logic here
    // }

    #[Route('/api/diaries', name: 'post_diary', methods:['POST'])]
    public function createDiary(Request $request): JsonResponse
    {
        // Extract diary data from the request body
        $diaryData = json_decode($request->getContent(), true);

        // Call the createDiary method of DiaryJsonFormatter
        $newDiaryData = $this->diaryJsonFormatter->createDiary($diaryData);

        // Return the response
        return new JsonResponse($newDiaryData, Response::HTTP_CREATED);
    }

    #[Route('/api/diaries/{diaryId}', name: 'put_diary', methods:['PUT'])]
    public function updateDiary(int $diaryId, Request $request): JsonResponse
    {
        // Extract diary data from the request body
        $diaryData = json_decode($request->getContent(), true);

        // Call the updateDiary method of DiaryJsonFormatter
        $updatedDiaryData = $this->diaryJsonFormatter->updateDiary($diaryId, $diaryData);

        if (!$updatedDiaryData) {
            return new JsonResponse(['error' => 'Diary not found'], Response::HTTP_NOT_FOUND);
        }

        // Return the response
        return new JsonResponse($updatedDiaryData, Response::HTTP_OK);
    }

    #[Route('/api/diaries/{diaryId}', name: 'del_diary', methods:['DELETE'])]
    public function deleteDiary(int $diaryId): JsonResponse
    {
        // Call the deleteDiary method of DiaryJsonFormatter
        $isDeleted = $this->diaryJsonFormatter->deleteDiary($diaryId);

        if (!$isDeleted) {
            return new JsonResponse(['error' => 'Diary not found'], Response::HTTP_NOT_FOUND);
        }

        // Return the response
        return new JsonResponse(['message' => 'Diary deleted successfully'], Response::HTTP_OK);
    }
}

