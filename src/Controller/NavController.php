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
     * @Route("/prestataire", name="prestataire")
     */
    public function prestataire(): Response
    {
        return $this->render('/btp/prestataire/prestataire.html.twig');
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

    /**
     * @Route("/admin/approval", name="approval_account")
     */
    public function approvalAccount(): Response
    {
        $repo = $this->getDoctrine()->getRepository(User::class);

        //$users =
        $users = $repo->findBy(array('awaitingApproval' => true));

        return $this->render('btp/approval_account.html.twig',[
            'users' => $users
        ]);
    }






//    #[Route("/blog/articles/12", name:"blog_show")]
//    public function show(): Response
//    {
//        return $this->render('blog/show.html.twig');
//    }
}
