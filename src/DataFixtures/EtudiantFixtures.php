<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 20; $i++) { 
            $etudiant = new Etudiant();

            $etudiant->setNom($faker->lastName())
                ->setPrenom($faker->firstName());

            $manager->persist($etudiant);
            $this->addReference('etudiant_' . $i, $etudiant);
        }


        $manager->flush();
    }
}
