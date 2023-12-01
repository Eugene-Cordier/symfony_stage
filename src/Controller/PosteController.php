<?php

namespace App\Controller;

use App\Repository\PosteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PosteController extends AbstractController
{
    #[Route('/poste', name: 'app_poste')]
    public function index(PosteRepository $posteRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');
        $postes = $posteRepository->search($search);

        return $this->render('poste/index.html.twig', [
            'postes' => $postes,
            'search' => $search,
        ]);
    }
}
