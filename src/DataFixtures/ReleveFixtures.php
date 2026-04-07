<?php

namespace App\DataFixtures;

use App\Entity\Releve;
use App\Entity\Binome;
use App\DataFixtures\BinomeFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ReleveFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 10; $i++) { 

            $binome = $this->getReference('binome_' . $i, Binome::class);
            $releve = new Releve();

            $releve->setTemperature($faker->numberBetween(0, 40))
                ->setCO2dissous($faker->numberBetween(0, 99))
                ->setPH4($faker->numberBetween(0, 14))
                ->setGH($faker->numberBetween(0, 99))
                ->setKH($faker->numberBetween(0, 99))
                ->setChlore($faker->numberBetween(0, 9))
                ->setNitrite($faker->numberBetween(0, 9))
                ->setNitrate($faker->numberBetween(0, 9))
                ->setDate($faker->dateTimeThisYear())
                ->setBinome($binome)
                ->setRemarque($faker->sentence());
                
            $manager->persist($releve);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            BinomeFixtures::class,
        ];
    }
}
