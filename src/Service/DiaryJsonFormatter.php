<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Diary;

class DiaryJsonFormatter
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getDiaryDetails(int $diaryId): ?array
    {
        $diary = $this->entityManager->getRepository(Diary::class)->find($diaryId);

        if (!$diary) {
            return null;
        }

        return [
            'id' => $diary->getId(),
            'user_pseudonym' => $diary->getUserPseudonym(),
            'open' => $diary->isOpen(),
            'created_at' => $diary->getCreatedAt()->format('Y-m-d H:i:s'),
            'duration' => $diary->getDuration(),
            // Add other diary details as needed
        ];
    }

    public function createDiary(array $data): ?array
    {
        $diary = new Diary();
        $diary->setUserPseudonym($data['user_pseudonym']);
        $diary->setOpen($data['open']);
        $diary->setCreatedAt(new \DateTimeImmutable($data['created_at']));
        $diary->setDuration($data['duration']);
        // Set other diary properties as needed

        $this->entityManager->persist($diary);
        $this->entityManager->flush();

        return $this->getDiaryDetails($diary->getId());
    }

    public function updateDiary(int $diaryId, array $data): ?array
    {
        $diary = $this->entityManager->getRepository(Diary::class)->find($diaryId);

        if (!$diary) {
            return null;
        }

        $diary->setUserPseudonym($data['user_pseudonym']);
        $diary->setOpen($data['open']);
        $diary->setCreatedAt(new \DateTimeImmutable($data['created_at']));
        $diary->setDuration($data['duration']);
        // Update other diary properties as needed

        $this->entityManager->flush();

        return $this->getDiaryDetails($diary->getId());
    }

    public function deleteDiary(int $diaryId): bool
    {
        $diary = $this->entityManager->getRepository(Diary::class)->find($diaryId);

        if (!$diary) {
            return false;
        }

        $this->entityManager->remove($diary);
        $this->entityManager->flush();

        return true;
    }
}
