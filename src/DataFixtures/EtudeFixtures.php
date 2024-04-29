<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Etude;
use Doctrine\Common\Collections\ArrayCollection;

class EtudeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        /* CATEGORIE DE NIVEAU 1 */
        $etudes = [
            "Architecture, Sciences de l'homme et sociétés, Territoires, Urbanismes, Géographie", "Art, Communication, Création, Cultures, Langues, Lettres, Sciences humaines", "Biologie, Chimie, Santé, STAPS", "Droit, Economie, Etudes politiques, Gestion, Management",
            "Environnement, Matériaux, Physique, Terre", "Informatique, Mathématiques, Sciences et technologies de l'information et de la communication", "Vie social & divertissements", "Ingénierie", "Métiers de la foramtion et de l'enseignement",
        ];

        for ($i = 0; $i< count($etudes); $i++) {

            $etude = new Etude();
            
            $etude  
                ->setName($etudes[$i])
                ->setFiliere(null)
            ;
            
            $manager->persist($etude);
        }
        
        $manager->flush();
        
        /* CATEGORIE DE NIVEAU 2 */
        $souscategories1 = [
            "Licence professionnelle Protection et valorisation du patrimoine historique et culturel", "Master Design", "Master Sciences cognitives", "BUT Carrières sociales", "Licence Géographie et aménagement"
        ];

        for ($i = 0; $i< count($souscategories1); $i++) {

            $souscategory = new Etude();

            $parentFiliere = $manager->getRepository(Etude::class)->find(1);

            $souscategory  
                ->setName($souscategories1[$i])
                ->setFiliere($parentFiliere)
            ;
            
            $manager->persist($souscategory);
            $parentFiliere->addCursus($souscategory);
        }
        
        $manager->flush();
    }
}