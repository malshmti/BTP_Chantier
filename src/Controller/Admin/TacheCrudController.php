<?php

namespace App\Controller\Admin;

use App\Entity\Tache;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class TacheCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tache::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
           'nom',
           'description',
            'duree',
            DateField::new('dateDebut')
                ->setTimezone("Europe/Paris")
                ->renderAsChoice(),
            AssociationField::new('phase'),
        ];
    }

    /*public function editSettingAction()
    {
        $response = parent::editAction();

        if ($response instanceof RedirectResponse) {
            return $this->redirectToRoute('admin', ['entity' => 'Setting', 'action' => 'edit', 'id' => 1]);
        }

        return $response;
    }*/
}
