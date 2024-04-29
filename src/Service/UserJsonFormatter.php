<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class UserJsonFormatter
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getUserDetails(int $userId): ?array
    {
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            return null;
        }

        return [
            'id' => $user->getId(),
            'pseudonyme' => $user->getPseudonyme(),
            // Add other user details as needed
        ];
    }

    public function createUser(array $data): ?array
    {
        $user = new User();
        $user->setPseudonyme($data['pseudonyme']);
        // Set other user properties as needed

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->getUserDetails($user->getId());
    }

    public function updateUser(int $userId, array $data): ?array
    {
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            return null;
        }

        $user->setPseudonyme($data['pseudonyme']);
        // Update other user properties as needed

        $this->entityManager->flush();

        return $this->getUserDetails($user->getId());
    }

    public function deleteUser(int $userId): bool
    {
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            return false;
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return true;
    }
}
