<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setEmail("user@mail.com")
            ->setPassword("password")
            ->setNewsCategory(['"general"'])
            ->setNewsCountry("fr")
        ;

        $manager->persist($user);

        $manager->flush();
    }
}
