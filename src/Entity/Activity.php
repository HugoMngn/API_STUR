<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'activity', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Diary $diary = null;

    #[ORM\OneToOne(inversedBy: 'activity', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\Column(length: 255)]
    private ?string $metadata = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiaryId(): ?Diary
    {
        return $this->diary;
    }

    public function setDiaryId(Diary $diary): static
    {
        $this->diary = $diary;

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->category;
    }

    public function setCategoryId(Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    public function setMetadata(string $metadata): static
    {
        $this->metadata = $metadata;

        return $this;
    }
}
