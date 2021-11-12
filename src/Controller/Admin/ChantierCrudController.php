<?php

namespace App\Controller\Admin;

use App\Entity\Chantier;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ChantierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chantier::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
           'nom',
           'description',
           'localisation'
        ];
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
