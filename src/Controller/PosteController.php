<?php

namespace App\Controller;

use App\Repository\PosteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PosteController extends AbstractController
{
    #[Route('/poste', name: 'app_poste')]
    public function index(PosteRepository $posteRepository): Response
    {
        $postes = $posteRepository->findAll();

        return $this->render('poste/index.html.twig', [
            'postes' => $postes,
        ]);
    }
}
