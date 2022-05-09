<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class UsersFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user1 = (new Users())
            ->setEmail('animateur@gmail.com')
            ->setName('TEST')
            ->setSurname('Animateur')
            ->setAlias('AnimTest')
            ->setRoles(array('ROLE_ANIMATEUR'));
        $password = $this->hasher->hashPassword($user1, '123456');
        $user1->setPassword($password);
        $manager->persist($user1);

        $user2 = (new Users())
            ->setEmail('parent@gmail.com')
            ->setName("TEST")
            ->setSurname("Parent")
            ->setRoles(array('ROLE_PARENT'));
        $password = $this->hasher->hashPassword($user2, '123456');
        $user2->setPassword($password);
        $manager->persist($user2);

        $user3 = (new Users())
            ->setEmail('admin@gmail.com')
            ->setRoles(array('ROLE_ADMIN'));
        $password = $this->hasher->hashPassword($user3, '123456');
        $user3->setPassword($password);
        $manager->persist($user3);

        $user4 = (new Users())
            ->setEmail('superadmin@gmail.com')
            ->setRoles(array('ROLE_SUPER_ADMIN'));
        $password = $this->hasher->hashPassword($user4, '123456');
        $user4->setPassword($password);
        $manager->persist($user4);

        $faker = Faker\Factory::create('fr_FR'); // create a French faker

        for ($i = 0; $i < 20; $i++) {
            $user = new Users();
            $user
                ->setSurname($faker->firstName)
                ->setName($faker->lastName)
                ->setEmail($faker->email)
                ->setActif(true)
                ->setRoles(array($faker->randomElement(["ROLE_PARENT", "ROLE_ANIMATEUR"])));
            $password = $this->hasher->hashPassword($user, '123456');
            $user->setPassword($password);
            $manager->persist($user);
        }

        $manager->flush();
        $this->addReference('anim', $user1);
        $this->addReference('parent', $user2);
    }
}
