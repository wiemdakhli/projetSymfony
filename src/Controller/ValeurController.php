<?php

namespace App\Controller;

use App\Entity\Valeur;
use App\Form\ValeurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/valeur")
 */
class ValeurController extends AbstractController
{
    /**
     * @Route("/", name="valeur_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $valeurs = $entityManager
            ->getRepository(Valeur::class)
            ->findAll();

        return $this->render('valeur/index.html.twig', [
            'valeurs' => $valeurs,
        ]);
    }

    /**
     * @Route("/new", name="valeur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $valeur = new Valeur();
        $form = $this->createForm(ValeurType::class, $valeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $valeur->setdateHeure(new \DateTime());
            $entityManager->persist($valeur);
            $entityManager->flush();

            return $this->redirectToRoute('valeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('valeur/new.html.twig', [
            'valeur' => $valeur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{idValeur}", name="valeur_show", methods={"GET"})
     */
    public function show(Valeur $valeur): Response
    {
        return $this->render('valeur/show.html.twig', [
            'valeur' => $valeur,
        ]);
    }

    /**
     * @Route("/{idValeur}/edit", name="valeur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Valeur $valeur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ValeurType::class, $valeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $capteur->setDateHeure(new \DateTime());
            $entityManager->flush();

            return $this->redirectToRoute('valeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('valeur/edit.html.twig', [
            'valeur' => $valeur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{idValeur}", name="valeur_delete", methods={"POST"})
     */
    public function delete(Request $request, Valeur $valeur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$valeur->getIdValeur(), $request->request->get('_token'))) {
            $entityManager->remove($valeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('valeur_index', [], Response::HTTP_SEE_OTHER);
    }
}
