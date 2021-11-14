<?php

namespace App\Controller\Admin;

use App\Entity\Chantier;
use App\Entity\Phase;
use App\Entity\Prestataire;
use App\Entity\Tache;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BTP');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Chantier', 'fas fa-star', Chantier::class);
        yield MenuItem::linkToCrud('Phase', 'fas fa-star', Phase::class);
        yield MenuItem::linkToCrud('Tache', 'fas fa-star', Tache::class);
        yield MenuItem::linkToCrud('Prestataire', 'fas fa-star', Prestataire::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
