<?php

namespace App\Controller\Admin;

use App\Entity\Administrateur;
use App\Entity\Etudiant;
use App\Entity\Entreprise;
use App\Entity\EtudiantPoste;
use App\Entity\Poste;
use App\Entity\Recruteur;
use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Sae3 01');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Etudiant', 'fas fa-list', Etudiant::class);
        yield MenuItem::linkToCrud('Recruteur', 'fas fa-list', Recruteur::class);
        yield MenuItem::linkToCrud('Entreprise', 'fas fa-list', Entreprise::class);
        yield MenuItem::linkToCrud('Poste', 'fas fa-list', Poste::class);
        yield MenuItem::linkToCrud('Tag', 'fas fa-list', Tag::class);
        yield MenuItem::linkToCrud('EtudiantPostes', 'fas fa-list', etudiantPoste::class);
        yield MenuItem::linkToCrud('Administrateur', 'fas fa-list', Administrateur::class);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('https://fonts.googleapis.com/icon?family=Material+Icons');
    }
}
