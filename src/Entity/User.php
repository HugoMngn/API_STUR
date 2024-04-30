<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudonyme = null;

    #[ORM\Column(length: 255)]
    private ?string $email_adress = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 255)]
    private ?string $gender = null;

    /**
     * @var Collection<int, Etude>
     */
    #[ORM\ManyToMany(targetEntity: Etude::class, cascade:["persist"], inversedBy: 'users')]
    private Collection $etudes;

    public function __construct()
    {
        $this->etudes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudonyme(): ?string
    {
        return $this->pseudonyme;
    }

    public function setPseudonyme(string $pseudonyme): static
    {
        $this->pseudonyme = $pseudonyme;

        return $this;
    }

    public function getEmailAdress(): ?string
    {
        return $this->email_adress;
    }

    public function setEmailAdress(string $email_adress): static
    {
        $this->email_adress = $email_adress;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection<int, etude>
     */
    public function getEtudes(): Collection
    {
        return $this->etudes;
    }

    public function addEtude(etude $etude): static
    {
        if (!$this->etudes->contains($etude)) {
            $this->etudes->add($etude);
        }

        return $this;
    }

    public function removeEtude(etude $etude): static
    {
        $this->etudes->removeElement($etude);

        return $this;
    }
}
