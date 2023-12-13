<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StageDescriptionController extends AbstractController
{
    #[Route('/stage/description', name: 'app_stage_description')]
    public function index(): Response
    {
        return $this->render('stage_description/index.html.twig', [
            'controller_name' => 'StageDescriptionController',
        ]);
    }
}
