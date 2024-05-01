<?php
namespace App\Service;

use App\Entity\Etude;
use Doctrine\ORM\EntityManagerInterface;

class EtudeJsonFormatter
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEtudeDetails(int $id): ?array
    {
        $etude = $this->entityManager->getRepository(Etude::class)->find($id);

        if (!$etude) {
            return null;
        }

        return [
            'id' => $etude->getId(),
            'name' => $etude->getName(),
            'filiere' => $etude->getFiliere() ? $this->formatEtude($etude->getFiliere()) : null,
            'cursus' => $this->formatCursus($etude->getCursus()),
        ];
    }

    public function createEtude(array $data): array
    {
        $etude = new Etude();
        $etude->setName($data['name']);

        if (isset($data['filiereId'])) {
            $filiere = $this->entityManager->getRepository(Etude::class)->find($data['filiereId']);
            if ($filiere) {
                $etude->setFiliere($filiere);
            } else {
                return ['error' => 'Filiere not found'];
            }
        }

        $this->entityManager->persist($etude);
        $this->entityManager->flush();

        return $this->getEtudeDetails($etude->getId());
    }

    public function updateEtude(int $id, array $data): ?array
    {
        $etude = $this->entityManager->getRepository(Etude::class)->find($id);

        if (!$etude) {
            return null;
        }

        $etude->setName($data['name']);

        if (isset($data['filiereId'])) {
            $filiere = $this->entityManager->getRepository(Etude::class)->find($data['filiereId']);
            if ($filiere) {
                $etude->setFiliere($filiere);
            } else {
                return ['error' => 'Filiere not found'];
            }
        } else {
            $etude->setFiliere(null);
        }

        $this->entityManager->flush();

        return $this->getEtudeDetails($etude->getId());
    }

    public function deleteEtude(int $id): bool
    {
        $etude = $this->entityManager->getRepository(Etude::class)->find($id);

        if (!$etude) {
            return false;
        }

        $this->entityManager->remove($etude);
        $this->entityManager->flush();

        return true;
    }

    private function formatEtude(Etude $etude): array
    {
        return [
            'id' => $etude->getId(),
            'name' => $etude->getName(),
        ];
    }

    private function formatCursus($cursus): array
    {
        $formattedCursus = [];

        foreach ($cursus as $etude) {
            $formattedCursus[] = $this->formatEtude($etude);
        }

        return $formattedCursus;
    }
}
