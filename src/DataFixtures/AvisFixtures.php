<?php
namespace App\DataFixtures;

use App\Entity\Avis;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AvisFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create('fr_FR'); // create a French faker

        for ($i = 0; $i < 10; $i++) {
            $avis = new Avis();
            $avis
                ->setText($faker->text(100))
                ->setCreatedAt(new DateTimeImmutable($faker->date))
                ->setRate($faker->numberBetween(0, 5));
            $manager->persist($avis);
        }
        $manager->flush();
    }
}
