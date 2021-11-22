<?php

namespace App\Controller\Admin;

use App\Entity\Phase;
use App\Entity\User;
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
        $fields = ['nom', 'description'];
        $repo = $this->getDoctrine()->getRepository(User::class);

        /** @var User|null $user */
            $user = $repo->findOneBy([
                'email' => $this->getUser()->getUserIdentifier()
            ]);
            if ($user) {
                $fields[] = AssociationField::new('chantier')->onlyOnForms()->setFormTypeOptions([
                    "choices" => $user->getChantiers()->toArray()
                ]);
            }

        return $fields;
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
