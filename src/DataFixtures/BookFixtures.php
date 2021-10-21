<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for($i =1 ; $i<=40; $i ++)
        {
            $book = new Book();
            $book->setTitle($faker->sentence(2));
            $book->setDescription( $faker->text );
            $book->setCover($faker->imageUrl('220','300'));
            $book->setAuthor($faker->name);
            $book->setGenre($faker->randomElement(['Histoire', 'Science fiction', 'Guides pratiques', 'Policier', 'Sciences','Droit et économie', 'manga']));
            $book->setReleaseDate($faker->dateTimeBetween('-6 months'));
            $manager->persist($book);
        }

        $manager->flush();
    }
}
