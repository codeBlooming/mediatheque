<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        //ADMIN
        $user = new User();
        $user->setEmail('greg@admin.fr');
        $user->setPassword('$2y$10$iVRaSpQhZw9CdacLxmIelefyt43Ly27yNDUarw9/1YUIn5Z1uLXZi');//admin
        $user->setFirstname('Greg');
        $user->setLastname('C');
        $user->setBirthdate(new \DateTime('1981-02-28'));
        $user->setAddress('14 rue des peupliers');
        $user->setUserValidated(true);
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);

        //EMPLOYEE
        $user = new User();
        $user->setEmail('alex@employee.fr');
        $user->setPassword('$2y$10$4nJInvwr/f4IPsDGPfZ0..Je2biNJ8F2985TaocCjnYj1wJZxGN.6');//test
        $user->setFirstname('Alex');
        $user->setLastname('C');
        $user->setBirthdate(new \DateTime('2010-08-28'));
        $user->setAddress('14 rue des peupliers');
        $user->setUserValidated(true);
        $user->setRoles(['ROLE_EMPLOYEE']);

        $manager->persist($user);


        //USER (validated)
        $user = new User();
        $user->setEmail('manon@user.fr');
        $user->setPassword('$2y$10$4nJInvwr/f4IPsDGPfZ0..Je2biNJ8F2985TaocCjnYj1wJZxGN.6');//test
        $user->setFirstname('Manon');
        $user->setLastname('C');
        $user->setBirthdate(new \DateTime('2007-09-04'));
        $user->setAddress('14 rue des peupliers');
        $user->setUserValidated(true);
        $user->setRoles(['ROLE_USER']);

        $manager->persist($user);


        //USER (No validated)
        $user = new User();
        $user->setEmail('jean@user.fr');
        $user->setPassword('$2y$10$4nJInvwr/f4IPsDGPfZ0..Je2biNJ8F2985TaocCjnYj1wJZxGN.6');//test
        $user->setFirstname('Jean');
        $user->setLastname('Dujardin');
        $user->setBirthdate(new \DateTime('1981-02-28'));
        $user->setAddress('21 rue de paris');
        $user->setUserValidated(false);
        $user->setRoles(['ROLE_USER']);

        $manager->persist($user);



        $manager->flush();
    }
}
