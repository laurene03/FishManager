<?php

namespace App\Controller;

use App\Entity\Releve;
use App\Form\ReleveType;
use App\Repository\ReleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReleveController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(ReleveRepository $releveRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $releve = new Releve();
        $form = $this->createForm(ReleveType::class, $releve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($releve);
            $entityManager->flush();

            $this->addFlash('success', 'Relevé enregistré avec succès !');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('releve/fishmanager.html.twig', [
            'form' => $form->createView(),
        ]);


        $this->addFlash("success", "Votre relevé a été enregistré avec succès !");
        $this->addFlash("error", "Une erreur est survenue lors de l'enregistrement du relevé.");

    }
}
