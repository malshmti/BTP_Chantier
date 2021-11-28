<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\b;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($form->get('typeActeur')->getData() == "Prestataire") {
                $user = new Prestataire();
                $form = $this->createForm(RegistrationFormType::class, $user);
                $form->handleRequest($request);
            }

            // encode the plain password
            $user->setPassword(
            $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setAwaitingApproval(true);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email


            switch($user->getTypeActeur()) {
                case "Prestataire":
                    return $this->redirectToRoute('dashboard_prestataire');
                case "Maitre d'ouvrage":
                    return $this->redirectToRoute('dashboard_maitreouvrage');
                case "Conducteur de travaux":
                    return $this->redirectToRoute('dashboard_conducteur');
            }

        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
