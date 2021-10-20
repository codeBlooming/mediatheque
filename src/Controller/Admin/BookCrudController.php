<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Book::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title')->setLabel('Titre'),
            TextareaField::new('description')->setLabel('Description')->hideOnIndex(),
            TextField::new('author')->setLabel('Auteur'),
            TextField::new('genre')->setLabel('Genre'),
            TextField::new('cover')->setLabel('Image de Couverture')->hideOnIndex(),
            DateField::new('releaseDate')->setLabel('Date de parution')->hideOnIndex(),
            BooleanField::new('isReserved')->setLabel('Réservé'),
            BooleanField::new('isBorrowed')->setLabel('Emprunté'),


        ];
    }

}
