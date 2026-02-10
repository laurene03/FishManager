<?php

namespace App\Controller\Admin;

use App\Entity\Binome;
use App\Entity\Etudiant;
use App\Entity\Releve;
use App\Entity\Repas;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {

        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(EtudiantCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FishManager');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Back to the website', 'fas fa-home', 'homepage');
        yield MenuItem::linkToCrud('Etudiants', 'fas fa-map-marker-alt', Etudiant::class);
        yield MenuItem::linkToCrud('Binome', 'fas fa-comments', Binome::class);
        yield MenuItem::linkToCrud('Relevé', 'fas fa-comments', Releve::class);
        yield MenuItem::linkToCrud('Repas', 'fas fa-comments', Repas::class);
    }
}
