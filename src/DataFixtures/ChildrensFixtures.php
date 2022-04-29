<?php
namespace App\DataFixtures;

use App\Entity\Childrens;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ChildrensFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create('fr_FR'); // create a French faker

        for ($i = 0; $i < 50; $i++) {
            $child = new Childrens();
            $child
                ->setName($faker->firstName)
                ->setAdditional($faker->text(100))
                ->setAgeRange($faker->randomElement(['4-6 ans', '6-8 ans', '8-12 ans', '12-16 ans']));
            $manager->persist($child);
        }
        $manager->flush();
    }
}
