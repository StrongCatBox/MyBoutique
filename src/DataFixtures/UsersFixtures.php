<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture

{

    private $passwordHasher;


    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $admin = new User();
        $admin->setfirstName('Jeina')
            ->setlastName('Salamova')
            ->setEmail('admin@gmal.com')
            ->setPassword($this->passwordHasher->hashPassword(
                $admin,
                'flower'
            ))
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);


        $faker = Factory::create('fr_FR');


        for ($i = 1; $i <= 10; $i++) {

            $user = new User();
            $user->setfirstName($faker->firstName())
                ->setlastName($faker->lastName())
                ->setEmail($faker->email())
                ->setPassword($this->passwordHasher->hashPassword(
                    $admin,
                    'a'
                ));

            $manager->persist($user);
        };

        $manager->flush();
    }
}
