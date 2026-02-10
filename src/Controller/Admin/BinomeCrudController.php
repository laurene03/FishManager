<?php

namespace App\Controller\Admin;

use App\Entity\Binome;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BinomeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Binome::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('etudiant1'),
            AssociationField::new('etudiant2'),
        ];
    }
}
