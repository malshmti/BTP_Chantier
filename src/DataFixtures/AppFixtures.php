<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();

        // Création de l'administrateur au début

        $user = new User();
        $user->setEmail("admin@root.com");
        $user->setAwaitingApproval(false);
        $user->setPassword('$2y$13$l8DOukqh6iYI1.5XFKQd8.vj.9KkoivJ0fbrzIY2gSSJfqKxZYypq');
        $user->addRole("ROLE_ADMIN");
        $user->setTypeActeur("Administrateur");

        $manager->persist($user);
        $manager->flush();
    }
}
