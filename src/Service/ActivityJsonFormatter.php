<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Activity;
use App\Entity\Diary;
use App\Entity\Category;

class ActivityJsonFormatter
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getActivityDetails(int $activityId): ?array
    {
        $activity = $this->entityManager->getRepository(Activity::class)->find($activityId);
    
        if (!$activity) {
            return null;
        }
    
        return [
            'id' => $activity->getId(),
            'diary_id' => $activity->getDiaryId()->getId(),
            'category_id' => $activity->getCategoryId()->getId(),
            'metadata' => $activity->getMetadata(),
        ];
    }

    public function createActivity(array $data): ?array
    {
        $activity = new Activity();
        $activity->setDiaryId($this->entityManager->getReference(Diary::class, $data['diary_id']));
        $activity->setCategoryId($this->entityManager->getReference(Category::class, $data['category_id']));
        $activity->setMetadata($data['metadata']);
        // Set other activity properties as needed

        $this->entityManager->persist($activity);
        $this->entityManager->flush();

        return $this->getActivityDetails($activity->getId());
    }

    public function updateActivity(int $activityId, array $data): ?array
    {
        $activity = $this->entityManager->getRepository(Activity::class)->find($activityId);

        if (!$activity) {
            return null;
        }

        $activity->setDiaryId($this->entityManager->getReference(Diary::class, $data['diary_id']));
        $activity->setCategoryId($this->entityManager->getReference(Category::class, $data['category_id']));
        $activity->setMetadata($data['metadata']);

        $this->entityManager->flush();

        return $this->getActivityDetails($activity->getId());
    }

    public function deleteActivity(int $activityId): bool
    {
        $activity = $this->entityManager->getRepository(Activity::class)->find($activityId);

        if (!$activity) {
            return false;
        }

        $this->entityManager->remove($activity);
        $this->entityManager->flush();

        return true;
    }

    public function getAllActivities(array $filters): ?array
    {
        $activityRepository = $this->entityManager->getRepository(Activity::class);
    
        $criteria = [];
    
        if (isset($filters['category_id'])) {
            $criteria['category'] = $filters['category_id'];
        }
    
        if (isset($filters['metadata'])) {
            $criteria['metadata'] = $filters['metadata'];
        }
    
        $activities = $activityRepository->findBy($criteria);
    
        return $activities ?: null;
    }
    
}
