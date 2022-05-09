<?php

namespace App\DataFixtures;

use App\Entity\Activities;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ActivitiesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR'); // create a French faker
        $activities = ["Aller en campagne", "Aller à la plage", "Aller à la pêche"];

        for ($i = 0; $i < 50; $i++) {
            $activity = new Activities();
            $activity
                ->setStartOn(new DateTimeImmutable($faker->date))
                ->setAdress($faker->streetAddress)
                ->setCity($faker->city)
                ->setZipcode($faker->postcode)
                ->setStatus($faker->randomElement(['projet', 'en ligne', 'annule', 'termine']))
                ->setMinParticipants($faker->numberBetween(1, 10))
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin non consequat quam. Aenean interdum diam a varius lobortis. Nunc at lacus vel arcu blandit aliquet non a felis. Maecenas in egestas felis. Nullam fringilla arcu sed metus tempor, quis euismod leo ornare. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nulla a imperdiet turpis, nec ultricies risus. Nunc non molestie arcu. Fusce rhoncus mauris massa, at accumsan risus luctus eget. Aliquam nec placerat leo. Pellentesque consequat sem vel mi semper, nec tempor nunc aliquam. Donec lectus purus, congue et tempor ac, pulvinar non ex. Pellentesque.')
                ->setTitle($activities[array_rand($activities, 1)])
                ->setUser($this->getReference('anim'))
                ->setIllustration('/assets/img/activite_test.png');

            $manager->persist($activity);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            UsersFixtures::class,
        ];
    }
}
