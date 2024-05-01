<?php

namespace App\Controller;

use App\Service\ActivityJsonFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;

class ActivityController extends AbstractController
{
    private $activityJsonFormatter;

    public function __construct(ActivityJsonFormatter $activityJsonFormatter)
    {
        $this->activityJsonFormatter = $activityJsonFormatter;
    }

    #[Route('/api/activities', name: 'get_activity_full', methods:['GET'])]
    public function getAllActivities(Request $request): JsonResponse
    {
        $filters = $request->query->all();
        $activities = $this->activityJsonFormatter->getAllActivities($filters);

        return new JsonResponse($activities, Response::HTTP_OK);
    }

    #[Route('/api/activity', name: 'post_activity', methods:['POST'])]
    public function createActivity(Request $request): JsonResponse
    {
        $activityData = json_decode($request->getContent(), true);

        $newActivityData = $this->activityJsonFormatter->createActivity($activityData);

        return new JsonResponse($newActivityData, Response::HTTP_CREATED);
    }

    #[Route('/api/activity/{activityId}', name: 'put_activity', methods:['PUT'])]
    public function updateActivity(int $activityId, Request $request): JsonResponse
    {
        $activityData = json_decode($request->getContent(), true);

        $updatedActivityData = $this->activityJsonFormatter->updateActivity($activityId, $activityData);

        if (!$updatedActivityData) {
            return new JsonResponse(['error' => 'Activity not found'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($updatedActivityData, Response::HTTP_OK);
    }

    #[Route('/api/activity/{activityId}', name: 'del_activity', methods:['DELETE'])]
    public function deleteActivity(int $activityId): JsonResponse
    {
        $isDeleted = $this->activityJsonFormatter->deleteActivity($activityId);

        if (!$isDeleted) {
            return new JsonResponse(['error' => 'Activity not found'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(['message' => 'Activity deleted successfully'], Response::HTTP_OK);
    }
}
