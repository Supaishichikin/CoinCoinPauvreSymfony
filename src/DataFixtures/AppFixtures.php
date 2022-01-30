<?php

namespace App\DataFixtures;

use App\Factory\AnnonceFactory;
use App\Factory\QuestionFactory;
use App\Factory\ReponseFactory;
use App\Factory\UserFactory;
use App\Factory\VoteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(10);
        AnnonceFactory::createMany(10);
        QuestionFactory::createMany(10);
        ReponseFactory::createMany(10);
    }
}
