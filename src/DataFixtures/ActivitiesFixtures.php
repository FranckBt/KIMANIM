<?php
namespace App\DataFixtures;

use App\Entity\Activities;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ActivitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR'); // create a French faker
        $activities = ["Aller en campagne", "Aller à la plage", "Aller à la pêche"];

        for ($i = 0; $i < 100; $i++) {
            $activity = new Activities();
            $activity
                ->setStartOn(new DateTimeImmutable($faker->date))
                ->setAdress($faker->streetAddress)
                ->setCity($faker->city)
                ->setZipcode($faker->postcode)
                ->setDescription($activities[array_rand($activities,1)])
                ->setStatus($faker->randomElement(['Projet', 'Animateur requis', 'Confirmé', 'Annulé', 'Terminé']))
                ->setMinParticipants($faker->numberBetween(1, 10));
                
            $manager->persist($activity);

        }
        $manager->flush();
    }
}
