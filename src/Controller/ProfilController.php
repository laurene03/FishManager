<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfilController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function index(): Response
    {
        // Données temporaires - à remplacer par les vraies données utilisateur
        $user = [
            'firstName' => 'Prénom',
            'lastName' => 'NOM',
            'binome' => 'Prénom NOM',
            'dateDebut' => new \DateTime('2026-03-01'),
            'dateFin' => new \DateTime('2026-03-18'),
            'dernierRepas' => new \DateTime('2026-03-21'),
            'taches' => [],
        ];

        return $this->render('profil/profil.html.twig', [
            'user' => $user,
        ]);
    }
}
