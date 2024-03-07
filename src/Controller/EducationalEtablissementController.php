<?php

namespace App\Controller;

use App\Entity\EducationalEtablissement;
use App\Form\EducationalEtablissementType;
use App\Repository\EducationalEtablissementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/educational/etablissement')]
class EducationalEtablissementController extends AbstractController
{
    #[Route('/', name: 'app_educational_etablissement_index', methods: ['GET'])]
    public function index(EducationalEtablissementRepository $educationalEtablissementRepository): Response
    {
        return $this->render('educational_etablissement/index.html.twig', [
            'educational_etablissements' => $educationalEtablissementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_educational_etablissement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $educationalEtablissement = new EducationalEtablissement();
        $form = $this->createForm(EducationalEtablissementType::class, $educationalEtablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($educationalEtablissement);
            $entityManager->flush();

            return $this->redirectToRoute('app_educational_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('educational_etablissement/new.html.twig', [
            'educational_etablissement' => $educationalEtablissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_educational_etablissement_show', methods: ['GET'])]
    public function show(EducationalEtablissement $educationalEtablissement): Response
    {
        return $this->render('educational_etablissement/show.html.twig', [
            'educational_etablissement' => $educationalEtablissement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_educational_etablissement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EducationalEtablissement $educationalEtablissement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EducationalEtablissementType::class, $educationalEtablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_educational_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('educational_etablissement/edit.html.twig', [
            'educational_etablissement' => $educationalEtablissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_educational_etablissement_delete', methods: ['POST'])]
    public function delete(Request $request, EducationalEtablissement $educationalEtablissement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$educationalEtablissement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($educationalEtablissement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_educational_etablissement_index', [], Response::HTTP_SEE_OTHER);
    }
}
