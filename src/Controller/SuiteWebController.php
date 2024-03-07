<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface; // Importez cette classe

class SuiteWebController extends AbstractController
{
    #[Route('/suiteWeb', name: 'app_suite_web')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $entity = new Contact();
            $entity->setName($formData['name']);
            $entity->setEmail($formData['email']);
            $entity->setSubject($formData['subject']);
            $entity->setMessage($formData['message']);

            $entityManager->persist($entity);
            $entityManager->flush();

            $this->addFlash('success', 'Your message has been sent and saved to the database. Thank you!');
        }

        return $this->render('suite_web/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
