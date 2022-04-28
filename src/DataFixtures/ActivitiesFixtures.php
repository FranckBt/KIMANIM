<?php

namespace App\DataFixtures;

use App\Entity\Activities;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActivitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $activity1 = new Activities();
        $activity1->setDescription('Activité en bord de mer');
        $manager->persist($activity1);

        $activity2 = new Activities();
        $activity2->setDescription('Activité en montagne');
        $manager->persist($activity2);

        $manager->flush();
    }
}
