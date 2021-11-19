<?php

namespace App\Controller\Admin;

use App\Entity\Chantier;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/approval", name="approval_account")
     */
    public function approvalAccount(): Response
    {
        $repo = $this->getDoctrine()->getRepository(User::class);

        //$users =
        $users = $repo->findBy(array('awaitingApproval' => true));

        return $this->render('admin/approval_account.html.twig',[
            'users' => $users
        ]);
    }

    /**
     * @Route("/admin/approval/{id}", name="approval_account_id")
     */
    public function approveAccount(User $user = null): Response
    {
        $repo = $this->getDoctrine()->getRepository(User::class);

        $repo->approveAccount($user);

        return $this->redirectToRoute('approval_account');
    }
}
