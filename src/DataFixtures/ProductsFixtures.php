<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 10; $i++) {

            $categorie = $this->getReference('categorie_' . $faker->numberBetween(1, 10));

            $name = $faker->words(3, true);

            $product = new Product();
            $product->setCategory($categorie)
                ->setName($faker->words(3, true))
                //->setSlug('$name.$i')
                ->setDescription($faker->paragraph(3))
                ->setSubtitle($faker->words(3, true))
                ->setPrice($faker->numberBetween(1000, 20000))
                ->setPicture($faker->image('C:\laragon\www\MyBoutique-main\public\uploads', 360, 360, 'animals', false, true, 'cats', true));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
