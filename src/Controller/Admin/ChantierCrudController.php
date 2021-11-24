<?php

namespace App\Controller\Admin;

use App\Entity\Chantier;
use App\Entity\Phase;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ChantierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chantier::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->overrideTemplate('crud/new', '/btp/maitreouvrage/crudnewchantier.html.twig')
            ->overrideTemplate('crud/edit', 'crudeditcustom.html.twig')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            'nom',
            'description',
            'localisation',
        ];

        $repo = $this->getDoctrine()->getRepository(User::class);

        /** @var User[]|null $users */
        $users = $repo->findBy(array('typeActeur' => 'Conducteur de travaux'));

        $fields[] = AssociationField::new('users')->onlyOnForms()->setFormTypeOptions([
            "choices" => $users
        ])
        ->setFormTypeOptionIfNotSet('by_reference', false)

        ;

        return $fields;
    }
//
//    protected function redirectToReferrer() {
//        if ($this->request->query->get('action') == 'new'){
//            return $this->redirectToRoute(
//                'Phase',
//                ['id'=> PropertyAccess::createPropertyAccessor()->getValue($this->request->attributes->get('easyadmin')['item'], $this->entity['chantier'])
//                ]
//            );
//        }
//
//        return parent::redirectToReferrer();
//    }

    protected function getRedirectResponseAfterSave(AdminContext $context, string $action): RedirectResponse
    {
        $repo = $this->getDoctrine()->getRepository(Chantier::class);

        /** @var Chantier|null $chantier */
        $chantier = $repo->find($context->getEntity()->getPrimaryKeyValue());

        return $this->redirectToRoute('maitreouvrage_consult_chantier', ['id' => $chantier->getId()]);
    }
}
