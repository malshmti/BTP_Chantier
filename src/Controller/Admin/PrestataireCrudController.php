<?php

namespace App\Controller\Admin;

use App\Entity\Prestataire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class PrestataireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prestataire::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
           'nom',
           EmailField::new('email'),
           'telephone'
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->overrideTemplate('crud/new', 'crudnewcustom.html.twig')
            ;
    }

    protected function redirectToReferrer() {
        if ($this->request->query->get('action') == 'new'){
            return $this->redirectToRoute(
                'Phase',
                ['id'=> PropertyAccess::createPropertyAccessor()->getValue($this->request->attributes->get('easyadmin')['item'], $this->entity['chantier'])
                ]
            );
        }

        return parent::redirectToReferrer();
    }
}
