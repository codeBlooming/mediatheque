<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname')->setLabel('Prénom')->setDisabled(),
            TextField::new('lastname')->setLabel('Nom')->setDisabled(),
            TextField::new('email')->setLabel('E-mail')->setDisabled(),
            DateField::new('birthdate')->setLabel('Date de naissance')->setDisabled(),
            TextField::new('Address')->setLabel('Adresse')->setDisabled(),
            BooleanField::new('user_validated')->setLabel('Autorisé'),
        ];
    }

}
