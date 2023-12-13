<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PosteDescriptionController extends AbstractController
{
    #[Route('/poste/description', name: 'app_poste_description')]
    public function index(): Response
    {
        return $this->render('poste_description/index.html.twig', [
            'controller_name' => 'PosteDescriptionController',
        ]);
    }
}
