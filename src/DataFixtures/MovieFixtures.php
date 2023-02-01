<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('en_US');
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        $faker->addProvider(new \Xylis\FakerCinema\Provider\TvShow($faker));

        for ($i=0; $i <= 20; $i++){
            $movie = (new Movie())
                ->setName($faker->movie())
                ->setSynopsis($faker->overview())
                ->setStudio($faker->studio())
                ->setGenre($faker->movieGenre())
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setType('MOVIE');

            $manager->persist($movie);
        }

        for ($i=0; $i <= 20; $i++){
            $show = (new Movie())
                ->setName($faker->tvShow())
                ->setSynopsis($faker->overview())
                ->setStudio($faker->tvNetwork())
                ->setGenre($faker->showGenre())
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setType('TV SHOW');

            $manager->persist($show);
        }

        $manager->flush();
    }
}
