<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\UserJsonFormatter;
class UserController extends AbstractController
{
    private $userJsonFormatter;

    public function __construct(UserJsonFormatter $userJsonFormatter)
    {
        $this->userJsonFormatter = $userJsonFormatter;
    }

    #[Route('/api/user', name: 'app_user', methods:['GET'])]
    public function getInfoUser(Request $request): JsonResponse
    {
        // You may want to extract user ID from the request parameters if needed
        $userId = $request->query->get('id');

        // Call the getUserDetails method of UserJsonFormatter
        $userDetails = $this->userJsonFormatter->getUserDetails($userId);

        if (!$userDetails) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($userDetails, Response::HTTP_OK);
    }

    #[Route('/api/user', name: 'post_user', methods:['POST'])]
    public function createUser(Request $request): JsonResponse
    {
        // Extract user data from the request body
        $userData = json_decode($request->getContent(), true);

        // Call the createUser method of UserJsonFormatter
        $newUserData = $this->userJsonFormatter->createUser($userData);

        // Return the response
        return new JsonResponse($newUserData, Response::HTTP_CREATED);
    }

    #[Route('/api/user', name: 'put_user', methods:['PUT'])]
    public function updateUser(Request $request): JsonResponse
    {
        // Extract user data from the request body
        $userData = json_decode($request->getContent(), true);

        // Call the updateUser method of UserJsonFormatter
        $updatedUserData = $this->userJsonFormatter->updateUser($userData['id'], $userData);

        if (!$updatedUserData) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        // Return the response
        return new JsonResponse($updatedUserData, Response::HTTP_OK);
    }

    #[Route('/api/user', name: 'del_user', methods:['DELETE'])]
    public function deleteUser(Request $request): JsonResponse
    {
        // Extract user ID from the request body
        $userId = $request->request->get('id');

        // Call the deleteUser method of UserJsonFormatter
        $isDeleted = $this->userJsonFormatter->deleteUser($userId);

        if (!$isDeleted) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        // Return the response
        return new JsonResponse(['message' => 'User deleted successfully'], Response::HTTP_OK);
    }
}
