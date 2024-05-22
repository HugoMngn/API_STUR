<?php

namespace App\Entity;

use App\Repository\EtudeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudeRepository::class)]
class Etude
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'cursus')]
    private ?Etude $filiere=null;

    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'filiere')]
    private Collection $cursus;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'etude')]
    private Collection $user;

    public function __construct()
    {
        $this->cursus = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFiliere(): ?self
    {
        return $this->filiere;
    }

    public function setFiliere(?self $filiere): static
    {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * @return Collection<int, Etude>
     */
    public function getCursus(): Collection
    {
        return $this->cursus;
    }

    public function addCursus(Etude $cursus): static
    {
        if (!$this->cursus->contains($cursus)) {
            $this->cursus->add($cursus);
            $cursus->setFiliere($this);
        }

        return $this;
    }

    public function removeCursus(Etude $cursus): static
    {
        if ($this->cursus->removeElement($cursus)) {
            // set the owning side to null (unless already changed)
            if ($cursus->getFiliere() === $this) {
                $cursus->setFiliere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->addEtude($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->user->removeElement($user)) {
            $user->removeEtude($this);
        }

        return $this;
    }
}
