<?php

namespace App\Controller\Admin;

use App\Entity\Phase;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->overrideTemplate('crud/new', 'btp/cdt/crudnewphase.html.twig')
            ->overrideTemplate('crud/edit', 'crudeditcustom.html.twig')

        ;
    }

    protected function getRedirectResponseAfterSave(AdminContext $context, string $action): RedirectResponse
    {
        $repo = $this->getDoctrine()->getRepository(Phase::class);

        /** @var Phase|null $phase */
        $phase = $repo->find($context->getEntity()->getPrimaryKeyValue());
        $chantier = $phase->getChantier();

        return $this->redirectToRoute('consult_chantier', ['id' => $chantier->getId()]);
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
