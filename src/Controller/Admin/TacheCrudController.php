<?php

namespace App\Controller\Admin;

use App\Entity\Phase;
use App\Entity\Tache;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TacheCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tache::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->overrideTemplate('crud/new', 'btp/cdt/crudnewtask.html.twig')
            ->overrideTemplate('crud/edit', 'crudeditcustom.html.twig')
            ;
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
            AssociationField::new('prestataire'),
            AssociationField::new('dependanceTache'),
        ];
    }

    protected function getRedirectResponseAfterSave(AdminContext $context, string $action): RedirectResponse
    {
        $repo = $this->getDoctrine()->getRepository(Tache::class);

        /** @var Tache|null $tache */
        $tache = $repo->find($context->getEntity()->getPrimaryKeyValue());
        $phase = $tache->getPhase();
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
