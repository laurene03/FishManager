<?php

namespace App\DataFixtures;

use App\Entity\Binome;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\DataFixtures\EtudiantFixtures;
use App\Entity\Etudiant;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BinomeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        for ($i=0; $i < 20; $i=$i+2) { 

            $etudiant1 = $this->getReference('etudiant_' . $i, Etudiant::class);
            $etudiant2 = $this->getReference('etudiant_' . ($i + 1), Etudiant::class);

            $binome = new Binome();

            $binome->setEtudiant1($etudiant1);
            $binome->setEtudiant2($etudiant2);

            $manager->persist($binome);
            $this->addReference('binome_' . ($i/2), $binome);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            EtudiantFixtures::class,
        ];
    }
}
