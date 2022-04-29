<?php

namespace App\DataFixtures;

use App\Entity\Activities;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActivitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $activity1 = new Activities();
        $activity1
            ->setStartOn(new DateTimeImmutable('2022-08-12'))
            ->setAdress('rue de la brossollette')
            ->setCity('Bordeaux')
            ->setZipcode(33000)
            ->setDescription('Activité en bord de mer')
            ->setStatus('A venir')
            ->setMinParticipants(5);

        $manager->persist($activity1);

        $activity2 = new Activities();
        $activity2
            ->setStartOn(new DateTimeImmutable('2022-09-10'))
            ->setAdress('20 allée du moulin vert')
            ->setCity('Marseille')
            ->setZipcode(13000)
            ->setDescription('Visite d\'un bateau')
            ->setStatus('A venir')
            ->setMinParticipants(10);

        $manager->persist($activity2);

        $manager->flush();
    }
}
