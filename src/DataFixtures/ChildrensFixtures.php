<?php
namespace App\DataFixtures;

use App\Entity\Childrens;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ChildrensFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create('fr_FR'); // create a French faker

        for ($i = 0; $i < 7; $i++) {
            $child = new Childrens();
            $child
                ->setName($faker->firstName)
                ->setAdditional('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin non consequat quam. Aenean interdum diam a varius lobortis. Nunc at lacus vel arcu blandit aliquet non a felis. Maecenas in egestas felis. Nullam fringilla arcu sed metus tempor, quis euismod leo ornare. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nulla a imperdiet turpis, nec ultricies risus. Nunc non molestie arcu. Fusce rhoncus mauris massa, at accumsan risus luctus eget. Aliquam nec placerat leo. Pellentesque consequat sem vel mi semper, nec tempor nunc aliquam. Donec lectus purus, congue et tempor ac, pulvinar non ex. Pellentesque.')
                ->setAgeRange($faker->randomElement(['4-6', '6-8', '8-12', '12-16']))
                ->setParent($this->getReference('parent'));
            $manager->persist($child);
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
