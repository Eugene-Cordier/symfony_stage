<?php

namespace App\Controller;

use App\Entity\Poste;
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
    #[Route('/poste/{id]',name: 'app_poste_info', requirements: ['contactId' => '\d+'])]
    public function show(Poste $poste): Response
    {
        return $this->render(
            'poste/show.html.twig',
            ['poste'=>$poste]
        );
    }
}
