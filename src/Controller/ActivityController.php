<?php

namespace App\Controller;

use App\Service\ActivityJsonFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivityController extends AbstractController
{
    private $activityJsonFormatter;

    public function __construct(ActivityJsonFormatter $activityJsonFormatter)
    {
        $this->activityJsonFormatter = $activityJsonFormatter;
    }

    // #[Route('/api/activity', name: 'app_activity', methods:['GET'])]
    // public function index(): JsonResponse
    // {
    //     // Implement index logic here
    // }

    #[Route('/api/activity', name: 'post_activity', methods:['POST'])]
    public function createActivity(Request $request): JsonResponse
    {
        // Extract activity data from the request body
        $activityData = json_decode($request->getContent(), true);

        // Call the createActivity method of ActivityJsonFormatter
        $newActivityData = $this->activityJsonFormatter->createActivity($activityData);

        // Return the response
        return new JsonResponse($newActivityData, Response::HTTP_CREATED);
    }

    #[Route('/api/activity/{activityId}', name: 'put_activity', methods:['PUT'])]
    public function updateActivity(int $activityId, Request $request): JsonResponse
    {
        // Extract activity data from the request body
        $activityData = json_decode($request->getContent(), true);

        // Call the updateActivity method of ActivityJsonFormatter
        $updatedActivityData = $this->activityJsonFormatter->updateActivity($activityId, $activityData);

        if (!$updatedActivityData) {
            return new JsonResponse(['error' => 'Activity not found'], Response::HTTP_NOT_FOUND);
        }

        // Return the response
        return new JsonResponse($updatedActivityData, Response::HTTP_OK);
    }

    #[Route('/api/activity/{activityId}', name: 'del_activity', methods:['DELETE'])]
    public function deleteActivity(int $activityId): JsonResponse
    {
        // Call the deleteActivity method of ActivityJsonFormatter
        $isDeleted = $this->activityJsonFormatter->deleteActivity($activityId);

        if (!$isDeleted) {
            return new JsonResponse(['error' => 'Activity not found'], Response::HTTP_NOT_FOUND);
        }

        // Return the response
        return new JsonResponse(['message' => 'Activity deleted successfully'], Response::HTTP_OK);
    }

    #[Route('/api/activities', name: 'get_activity_full', methods:['GET'])]
    public function getAllActivities(Request $request): JsonResponse
    {
        // Extract query parameters from the request
        $filters = $request->query->all();

        // Call the getAllActivities method of ActivityJsonFormatter
        $activities = $this->activityJsonFormatter->getAllActivities($filters);

        // Return the response
        return new JsonResponse($activities, Response::HTTP_OK);
    }
}
