<?php

namespace App\DataFixtures;

use App\Factory\AnnonceFactory;
use App\Factory\QuestionFactory;
use App\Factory\ReponseFactory;
use App\Factory\UserFactory;
use App\Factory\VoteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        Factory::create('en_US');
        UserFactory::createMany(10);
        AnnonceFactory::createMany(30);
        QuestionFactory::createMany(100);
        ReponseFactory::createMany(mt_rand(30, 100));
    }
}
