<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use Doctrine\Common\Collections\ArrayCollection;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        /* CATEGORIE DE NIVEAU 1 */
        $categories = [
            "Sommeil", "Soins Personnel", "Emplois Salariés", "Travail Académique", "Activités à domicile",
            "Activités familiales", "Activités associatives, politiques et bénévoles", "Vie social & divertissements", "Activités sportives", "Loisirs",
            "Utilisation des médias", "Déplacements"
        ];

        for ($i = 0; $i< count($categories); $i++) {

            $category = new Category();
           
            $category  
                ->setName($categories[$i])
                ->setParent(null)
            ;
            
            $manager->persist($category);
        }
        
        $manager->flush();

        /* CATEGORIE DE NIVEAU 2 */
        $souscategories2 = [
            "Repas", "Habillage – soins du corps", "Temps personnels"
        ];

        for ($i = 0; $i< count($souscategories2); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(2);

            $souscategory  
                ->setName($souscategories2[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $souscategories3 = [
            "Activité principale (salariée, indépendante…)", "Pauses durant l’activité (café…)", "Pauses déjeuner pendant l’activité"
        ];

        for ($i = 0; $i< count($souscategories3); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(3);

            $souscategory  
                ->setName($souscategories3[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        $manager->flush();

        $souscategories4 = [
            "Cours magistraux", "Echanges avec les enseignants", "TD/TP", "Travail académique personnel", "Travail de groupe", "Examens", "Pauses et repas pendant les activités d'étude"
        ];

        for ($i = 0; $i< count($souscategories4); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(4);

            $souscategory  
                ->setName($souscategories4[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $souscategories5 = [
            "Préparation des repas",
            "Installation/désinstallation table, vaisselle",
            "Nettoyage de la maison",
            "Lavage du linge (y compris le repassage)",
            "Jardinage et soins des animaux de compagnie, Bricolage, Entretien d’un véhicule",
            "Courses, achats",
            "Gestion des affaires domestiques (documents officiels, factures, démarches administratives"
        ];

        for ($i = 0; $i< count($souscategories5); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(5);

            $souscategory  
                ->setName($souscategories5[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $souscategories6 = [
            "Soins aux enfants",
            "Suivi du travail scolaire",
            "Jeux, lectures et discussions avec les enfants",
            "Transports des enfants",
            "Aide à un membre de la famille"
        ];

        for ($i = 0; $i< count($souscategories6); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(6);

            $souscategory  
                ->setName($souscategories6[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $souscategories7 = [
            "Travail associatif (réunions…)",
            "Aides aux personnes (courses, aides à domicile, garde d’enfants…)",
            "Activités religieuses",
            "Activités politiques (meeting…)"
        ];

        for ($i = 0; $i< count($souscategories7); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(7);

            $souscategory  
                ->setName($souscategories7[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        
        $souscategories8 = [
            "Vie sociale",
            "Activités en famille",
            "Rencontres avec des amis (visite ou réception)",
            "Fêtes",
            "Conversations téléphoniques",
            "Culture et divertissement"
        ];

        for ($i = 0; $i< count($souscategories8); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(8);

            $souscategory  
                ->setName($souscategories8[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $souscategories9 = [
            "Exercices physiques",
            "Autres activités de détente (pêche, chasse, cueillettes…)"
        ];

        for ($i = 0; $i< count($souscategories9); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(9);

            $souscategory  
                ->setName($souscategories9[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $souscategories10 = [
            "Pratique d’une activité artistique (musique, peinture…)",
            "Loisirs",
            "Jeux"
        ];

        for ($i = 0; $i< count($souscategories10); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(10);

            $souscategory  
                ->setName($souscategories10[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $souscategories11 = [
            "Lectures (livres, revues…)",
            "TV et vidéos",
            "Radio",
            "Consultations médias sur supports électroniques (tablettes, ordinateurs…)",
            "Jeux en ligne",
            "Réseaux sociaux",
            "Films, séries en ligne"
        ];

        for ($i = 0; $i< count($souscategories11); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(11);

            $souscategory  
                ->setName($souscategories11[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();


        $souscategories12 = [
            "Déplacements	pour	raisons	personnelles	(soins,	relations avec	une administration…)",
            "Déplacements pour aller/revenir du travail",
            "Déplacements pour aller/revenir de l’université/école",
            "Déplacements pour les courses et activités d’achat",
            "Transport d’un membre de la famille",
            "Déplacements dans un cadre associatif",
            "Déplacements liés à la vie sociale",
            "Déplacements lies aux activités de loisirs et de divertissement",
            "Déplacements pour activités sportives"
        ];

        for ($i = 0; $i< count($souscategories12); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(12);

            $souscategory  
                ->setName($souscategories12[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();


        /* CATEGORIE DE NIVEAU 3 */
        $sscat21 = [
            "Participation au TD (prise de note, lecture…)",
            "Présentation d’exposés",
            "Devoirs sur table",
            "Travail en laboratoire",
            "Communications avec les chargés de TD/TP"
        ];

        for ($i = 0; $i< count($sscat21); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(21);

            $souscategory  
                ->setName($sscat21[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $sscat22 = [
            "Révisions (écriture de fiches, relectures…)",
            "Documentation (lecture, recherche documentaire, fiche de lecture…)",
            "Préparation (exposé, TD, exercices…)",
            "Reprise de cours (suite à une absence, remise en forme…)",
            "Recherche de compléments au cours",
            "Planification du travail académique"
        ];

        for ($i = 0; $i< count($sscat22); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(22);

            $souscategory  
                ->setName($sscat22[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $sscat23 = [
            "Préparations exposés…",
            "Révisions collectives",
            "Echanges sur les cours",
            "Concertation avec les autres étudiants"
        ];

        for ($i = 0; $i< count($sscat23); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(23);

            $souscategory  
                ->setName($sscat23[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $sscat24 = [
            "Examen en salle",
            "Consultation de copies",
            "Consultation d’annales"
        ];

        for ($i = 0; $i< count($sscat24); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(24);

            $souscategory  
                ->setName($sscat24[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $sscat25 = [
            "Pause",
            "Repas"
        ];

        for ($i = 0; $i< count($sscat25); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(25);

            $souscategory  
                ->setName($sscat25[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $sscat47 = [
            "Cinéma",
            "Théâtre et concerts",
            "Musées, expositions",
            "Bibliothèque",
            "Evènements sportifs"
        ];

        for ($i = 0; $i< count($sscat47); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(47);

            $souscategory  
                ->setName($sscat47[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $sscat48 = [
            "Marche et randonnée",
            "Jogging et course à pieds",
            "Vélo, ski, sports de glisse",
            "Jeux avec ballons",
            "Gymnastique",
            "Fitness",
            "Sports nautiques (natation…)",
            "Autre"
        ];

        for ($i = 0; $i< count($sscat48); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(48);

            $souscategory  
                ->setName($sscat48[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $sscat51 = [
            "Lectures (magazines, revues…)",
            "Correspondance (y compris SMS…)",
            "Autres loisirs"
        ];

        for ($i = 0; $i< count($sscat51); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(51);

            $souscategory  
                ->setName($sscat51[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();

        $sscat52 = [
            "Jeux de société",
            "Jeux électroniques",
            "Autres jeux"
        ];

        for ($i = 0; $i< count($sscat52); $i++) {

            $souscategory = new Category();

            $parentCategory = $manager->getRepository(Category::class)->find(52);

            $souscategory  
                ->setName($sscat52[$i])
                ->setParent($parentCategory)
            ;
            
            $manager->persist($souscategory);
            $parentCategory->addChild($souscategory);
        }
        
        $manager->flush();
    }
}