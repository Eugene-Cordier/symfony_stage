<?php

namespace App\Controller;

use App\Entity\EtudiantPoste;
use App\Entity\Poste;
use App\Form\EtudiantPosteType;
use App\Repository\PosteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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

    #[Route('/poste/{id}', name: 'app_poste_info', requirements: ['id' => '\d+'])]
    public function show(
        #[MapEntity(expr: 'repository.findWithTagAndEntreprise(id)')]
        Poste $poste): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_etudiant_poste', ['id' => $poste->getId()]);
        }

        return $this->render(
            'poste/show.html.twig',
            ['poste' => $poste]
        );
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/poste/{id}/inscription', name: 'app_insc_poste', requirements: ['id' => '\d+'])]
    public function inscription(Poste $poste, Request $request, EntityManagerInterface $entityManager): Response
    {
        $etudPoste = new EtudiantPoste();
        $form = $this->createForm(EtudiantPosteType::class, $etudPoste);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $etudPoste->setCv(file_get_contents($form->get('cv')->getData()));
            $etudPoste->setPoste($poste);
            $etudPoste->setEtudiant($this->getUser());
            $etudPoste->setStatut('en attente');
            $entityManager->persist($etudPoste);
            $entityManager->flush();

            return $this->redirectToRoute('app_poste_info', ['id' => $poste->getId()]);
        }

        return $this->render('poste/inscription.html.twig', ['form' => $form]);
    }
}
