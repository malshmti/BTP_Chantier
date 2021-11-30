<?php

namespace App\Controller\Api;

use App\Entity\Chantier;
use App\Repository\ChantierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CoursRepository;
use App\Entity\Cours;
use DateTime;

/**
 * @Route("/api/chantiers", name="api_cours_")
 */
class ChantierController extends AbstractController
{
    /**
     * @Route("", name="index", methods={"GET"})
     */
    public function index(ChantierRepository $repository): JsonResponse
    {
        $chantiers = $repository->findAll();
        return $this->json($chantiers, 200);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Chantier $chantier = null): JsonResponse
    {
        if (is_null($chantier)) {
            return $this->json([
                'message' => 'Ce chantier est introuvable',
            ], 404);
        }

        return $this->json($chantier);
    }

    protected function formatErrors($errors): array
    {
        $messages = [];
        foreach ($errors as $error) {
            $messages[$error->getPropertyPath()] = $error->getMessage();
        }

        return $messages;
    }
}