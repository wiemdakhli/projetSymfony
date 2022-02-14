<?php

namespace App\Controller;

use App\Entity\ValeurCapteur;
use App\Form\ValeurCapteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/valeur/capteur")
 */
class ValeurCapteurController extends AbstractController
{
    /**
     * @Route("/", name="valeur_capteur_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $valeurCapteurs = $entityManager
            ->getRepository(ValeurCapteur::class)
            ->findAll();

        return $this->render('valeur_capteur/index.html.twig', [
            'valeur_capteurs' => $valeurCapteurs,
        ]);
    }

    /**
     * @Route("/new", name="valeur_capteur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $valeurCapteur = new ValeurCapteur();
        $form = $this->createForm(ValeurCapteurType::class, $valeurCapteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($valeurCapteur);
            $entityManager->flush();

            return $this->redirectToRoute('valeur_capteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('valeur_capteur/new.html.twig', [
            'valeur_capteur' => $valeurCapteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{idValCap}", name="valeur_capteur_show", methods={"GET"})
     */
    public function show(ValeurCapteur $valeurCapteur): Response
    {
        return $this->render('valeur_capteur/show.html.twig', [
            'valeur_capteur' => $valeurCapteur,
        ]);
    }

    /**
     * @Route("/{idValCap}/edit", name="valeur_capteur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ValeurCapteur $valeurCapteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ValeurCapteurType::class, $valeurCapteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('valeur_capteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('valeur_capteur/edit.html.twig', [
            'valeur_capteur' => $valeurCapteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{idValCap}", name="valeur_capteur_delete", methods={"POST"})
     */
    public function delete(Request $request, ValeurCapteur $valeurCapteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$valeurCapteur->getIdValCap(), $request->request->get('_token'))) {
            $entityManager->remove($valeurCapteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('valeur_capteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
