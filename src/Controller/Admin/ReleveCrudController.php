<?php

namespace App\Controller\Admin;

use App\Entity\Releve;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReleveCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Releve::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('binome'),
            NumberField::new('temperature'),
            NumberField::new('CO2dissous'),
            NumberField::new('pH4'),
            NumberField::new('gH'),
            NumberField::new('kH'),
            NumberField::new('chlore'),
            NumberField::new('nitrite'),
            NumberField::new('nitrate'),
            DateField::new('date'),
            TextEditorField::new('remarque'),
        ];
    }


}
