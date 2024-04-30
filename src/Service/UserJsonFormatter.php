<?php

namespace App\Service;

use App\Entity\Etude;
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
        $etudesDetails = [];
        foreach ($user->getEtudes() as $etude) {
            $etudesDetails[] = [
                'id' => $etude->getId(),
                'name' => $etude->getName(),
            ];
        }
    
        return [
            'id' => $user->getId(),
            'pseudonyme' => $user->getPseudonyme(),
            'age' => $user->getAge(),
            'email' => $user->getEmailAdress(),
            'etudes' => $etudesDetails,
        ];
    }
    

    public function createUser(array $data): ?array
    {
        $user = new User();
        $user->setPseudonyme($data['pseudonyme']);
        $user->setEmailAdress($data['email_address']);
        $user->setAge($data['age']);
        $user->setGender($data['gender']);
    
        if (isset($data['etudes'])) {
            $etudeIds = $data['etudes'];
            foreach ($etudeIds as $etudeId) {
                $etude = $this->entityManager->getRepository(Etude::class)->find($etudeId);
                if ($etude) {
                    $user->addEtude($etude);
                } else {
                    return ['error' => 'ID invalide pour une étude'];
                }
            }
        }
    
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
        $user->setAge($data['Age']);
        $user->setEmailAdress($data['email']);
        $user->setGender($data['gender']);

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
