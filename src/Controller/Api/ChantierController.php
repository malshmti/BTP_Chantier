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
use App\Entity\AvisCours;
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
                'message' => 'Ce cours est introuvable',
            ], 404);
        }

        return $this->json($chantier);
    }

    /**
     * @Route("/jour/{day}", name="showByDay", methods={"GET"})
     */
    public function showByDay(string $day, CoursRepository $repository): JsonResponse
    {
        $format = "Y-m-d";
        $date = DateTime::createFromFormat($format, $day);
        $cours = $repository->getByDate($date);

        return $this->json($cours, 200);
    }

    /**
     * @Route("/{id}/avis", name="index_avis", methods={"GET"})
     */
    public function indexAvis(Cours $cours = null): JsonResponse
    {
        if (is_null($cours)) {
            return $this->json([
                'message' => 'Ce cours est introuvable',
            ], 404);
        }

        return $this->json($cours->getAvisCours()->toArray());
    }

    /**
     * @Route("/{id}/avis", name="create_avis", methods={"POST"})
     */
    public function createAvis(Request $request, Cours $cours = null, ValidatorInterface $validator, 
    EntityManagerInterface $em): JsonResponse
    {
        if (is_null($cours)) {
            return $this->json([
                'message' => 'Ce cours est introuvable',
            ], 404);
        }

        $data = json_decode($request->getContent(), true);
        $data['cours'] = $cours;
        $avis = new AvisCours($data);

        $errors = $validator->validate($avis);

        if ($errors->count() > 0) {
            return $this->json($this->formatErrors($errors), 400);
        }

        $em->persist($avis);
        $em->flush();

        return $this->json($avis, 201);
    }

    /**
     * @Route("/avis/{id}", name="delete_avis", methods={"DELETE"})
     */
    public function deleteAvis(AvisCours $avis = null, EntityManagerInterface $em): JsonResponse
    {
        if (is_null($avis)) {
            return $this->json([
                'message' => 'Cet avis est introuvable',
            ], 404);
        }

        $em->remove($avis);
        $em->flush();

        return $this->json(null , 204);
    }

    /**
     * @Route("/avis/{id}", name="update_avis", methods={"PATCH"})
     */
    public function updateAvis(Request $request, AvisCours $avis = null, ValidatorInterface $validator, EntityManagerInterface $em)
    {
        if (is_null($avis)) {
            return $this->json([
                'message' => 'Cet avis est introuvable',
            ], 404);
        }

        $data = json_decode($request->getContent(), true);
        $errors = $avis->updateFromArray($data);

        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $attribute) {
                $messages[$attribute] = "Cet attribute n'existe pas.";
            }

            return $this->json($messages, 400);
        }

        $errors = $validator->validate($avis);

        if ($errors->count() > 0) {
            return $this->json($this->formatErrors($errors), 400);
        }

        $em->persist($avis);
        $em->flush();

        return $this->json($avis, 200);
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