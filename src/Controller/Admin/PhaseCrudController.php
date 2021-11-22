<?php

namespace App\Controller\Admin;

use App\Entity\Phase;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class PhaseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Phase::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
           'nom',
           'description',
            AssociationField::new('chantier'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->overrideTemplate('crud/new', 'crudnewcustom.html.twig')
            ;
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
