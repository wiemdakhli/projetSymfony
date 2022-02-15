<?php

namespace App\Controller;

use App\Entity\Capteur;
use App\Form\CapteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/capteur")
 */
class CapteurController extends AbstractController
{
    /**
     * @Route("/", name="capteur_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $capteurs = $entityManager
            ->getRepository(Capteur::class)
            ->findAll();
        
        return $this->render('capteur/index.html.twig', [
            'capteurs' => $capteurs,
        ]);
    }

    /**
     * @Route("/new", name="capteur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $capteur = new Capteur();
        $form = $this->createForm(CapteurType::class, $capteur);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            $capteur->setCreatedAt(new \DateTime());
            $entityManager->persist($capteur);
            $entityManager->flush();

            return $this->redirectToRoute('capteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('capteur/new.html.twig', [
            'capteur' => $capteur,
            'form' => $form
        ]);
    }

    /**
     * @Route("/{idCapteur}", name="capteur_show", methods={"GET"})
     */
    public function show(Capteur $capteur): Response
    {
        return $this->render('capteur/show.html.twig', [
            'capteur' => $capteur,
        ]);
    }

    /**
     * @Route("/{idCapteur}/edit", name="capteur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Capteur $capteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CapteurType::class, $capteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('capteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('capteur/edit.html.twig', [
            'capteur' => $capteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{idCapteur}", name="capteur_delete", methods={"POST"})
     */
    public function delete(Request $request, Capteur $capteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$capteur->getIdCapteur(), $request->request->get('_token'))) {
            $entityManager->remove($capteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('capteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
