<?php

namespace App\Controller;

use App\Controller\Admin\PrestataireCrudController;
use App\Entity\Chantier;
use App\Entity\Prestataire;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavController extends AbstractController
{
    /**
    *@Route("/btp", name="btp")
    */
    public function index():Response
    {
        return $this->render('btp/index.html.twig', [
            'controller_name' => 'NavController',
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('btp/home.html.twig');
    }

    /**
    *@Route("/cdt", name="dashboard_conducteur")
    */
    public function dashboardCdt(): Response
    {
        $repo = $this->getDoctrine()->getRepository(User::class);

        $repo = $this->getDoctrine()->getRepository(Chantier::class);
        $repoPresta = $this->getDoctrine()->getRepository(Prestataire::class);


//        /** @var User|null $user */
//        $user = $repo->findOneBy([
//            'email' => $this->getUser()->getUserIdentifier()
//        ]);
//
//        $chantiers = $user->getChantier;


        $chantiers = $repo->findAll();
        $prestataires = $repoPresta->findAll();

        return $this->render('btp/cdt/dashboard_cdt.html.twig',[
            'chantiers' => $chantiers,
            'prestataires' => $prestataires,
        ]);
    }

    /**
     * @Route("/presta", name="dashboard_prestataire")
     */
    public function dashboardPresta(): Response
    {
        return $this->render('btp/presta/dashboard_presta.html.twig');
    }


    /**
     * @Route("/cdt/chantier/{id}", name="consult_chantier")
     */
    public function consultChantier($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Chantier::class);

        $chantier = $repo->find($id);

        return $this->render('btp/cdt/consult_chantier.html.twig',[
            'chantier' => $chantier,
            'phases' => $chantier->getPhases(),
        ]);
    }

    /**
     * @Route("/crea_chantier", name="add_chantier")
     */
    public function addChantier(): Response
    {
        return $this->render('btp/add_chantier.html.twig');

    }
//    /**
//     * @Route("/planning", name="planning_chantier")
//     */
//    public function gantt(): Response
//    {
//        $repo = $this->getDoctrine()->getRepository(Chantier::class);
//
//        $chantiers = $repo->findAll();
//
//        return $this->render('btp/planning.html.twig',[
//            'chantiers' => json_encode($chantiers),
//        ]);
//    }

    /**
     * @Route("/cdt/prestataire/{id}", name="consult_prestataire")
     */
    public function consultPrestataire($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Prestataire::class);

        $prestataire = $repo->find($id);

        return $this->render('btp/cdt/consult_prestataire.html.twig',[
            'prestataire' => $prestataire,
        ]);
    }

    /**
     * @Route("/maitreouvrage", name="dashboard_maitreouvrage")
     */
    public function dashMo(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Chantier::class);

        $chantiers = $repo->findAll();
        return $this->render('btp/maitreouvrage/dashboard_mo.html.twig',[
            'chantiers' => $chantiers,
        ]);
    }

    /**
     * @Route("/maitreouvrage/chantier/{id}", name="maitreouvrage_consult_chantier")
     */
    public function consultMo($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Chantier::class);

        $chantier = $repo->find($id);

        return $this->render('btp/maitreouvrage/consult_chantier.html.twig',[
            'chantier' => $chantier,
            'phases' => $chantier->getPhases(),
        ]);
    }




//    #[Route("/blog/articles/12", name:"blog_show")]
//    public function show(): Response
//    {
//        return $this->render('blog/show.html.twig');
//    }
}
