<?php

namespace App\Controller;

use App\Entity\Intervalle;
use App\Form\IntervalleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/intervalle")
 */
class IntervalleController extends AbstractController
{
    /**
     * @Route("/", name="intervalle_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $intervalles = $entityManager
            ->getRepository(Intervalle::class)
            ->findAll();

        return $this->render('intervalle/index.html.twig', [
            'intervalles' => $intervalles,
        ]);
    }

    /**
     * @Route("/new", name="intervalle_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $intervalle = new Intervalle();
        $form = $this->createForm(IntervalleType::class, $intervalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($intervalle);
            $entityManager->flush();

            return $this->redirectToRoute('intervalle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intervalle/new.html.twig', [
            'intervalle' => $intervalle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{idIntervalle}", name="intervalle_show", methods={"GET"})
     */
    public function show(Intervalle $intervalle): Response
    {
        return $this->render('intervalle/show.html.twig', [
            'intervalle' => $intervalle,
        ]);
    }

    /**
     * @Route("/{idIntervalle}/edit", name="intervalle_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Intervalle $intervalle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IntervalleType::class, $intervalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('intervalle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intervalle/edit.html.twig', [
            'intervalle' => $intervalle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{idIntervalle}", name="intervalle_delete", methods={"POST"})
     */
    public function delete(Request $request, Intervalle $intervalle, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$intervalle->getIdIntervalle(), $request->request->get('_token'))) {
            $entityManager->remove($intervalle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('intervalle_index', [], Response::HTTP_SEE_OTHER);
    }
}
