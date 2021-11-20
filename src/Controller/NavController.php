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
    *@Route("/dash", name="dashboard")
    */
    public function dashboard(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Chantier::class);
        $repoPresta = $this->getDoctrine()->getRepository(Prestataire::class);

        $chantiers = $repo->findAll();

        $prestataires = $repoPresta->findAll();

        return $this->render('btp/dashboard.html.twig',[
            'chantiers' => $chantiers,
            'prestataires' => $prestataires,
        ]);
    }

    /**
     * @Route("/prestataire/dash", name="prestataire")
     */
    public function prestataire(): Response
    {
        return $this->render('/btp/prestataire/dash.html.twig');
    }

    /**
     * @Route("/maitreouvrage/dash", name="maitreouvrage")
     */
    public function maitreouvrage(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Chantier::class);

        $chantiers = $repo->findAll();
         return $this->render('/btp/maitreouvrage/dash.html.twig',[
            'chantiers' => $chantiers,
        ]);
    }

    /**
     * @Route("/maitreouvrage/chantier/{id}", name="maitreouvrageconsult_chantier")
     */
    public function consultmaitreouvrage($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Chantier::class);

        $chantier = $repo->find($id);

        return $this->render('btp/maitreouvrage/consult_chantier.html.twig',[
            'chantier' => $chantier,
            'phases' => $chantier->getPhases(),
        ]);
    }


    /**
     * @Route("/btp/{id}", name="consult_chantier")
     */
    public function consult($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Chantier::class);

        $chantier = $repo->find($id);

        return $this->render('btp/consult_chantier.html.twig',[
            'chantier' => $chantier,
            'phases' => $chantier->getPhases(),
        ]);
    }


    /**
     * @Route("/planning", name="planning_chantier")
     */
    public function gantt(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Chantier::class);

        $chantiers = $repo->findAll();

        return $this->render('btp/planning.html.twig',[
            'chantiers' => json_encode($chantiers),
        ]);
    }






//    #[Route("/blog/articles/12", name:"blog_show")]
//    public function show(): Response
//    {
//        return $this->render('blog/show.html.twig');
//    }
}
