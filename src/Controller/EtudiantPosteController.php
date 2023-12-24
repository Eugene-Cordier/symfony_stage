<?php

namespace App\Controller;

use App\Entity\EtudiantPoste;
use App\Form\EtudiantPosteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantPosteController extends AbstractController
{
    #[Route('/etudiantPoste/{id}/delete_poste', name: 'app_etudiant_poste_delete')]
    public function deletePoste(Request $request, EtudiantPoste $etudiantPoste, EntityManagerInterface $entityManager)
    {
        $form = $this->createFormBuilder($etudiantPoste)
            ->add('delete', SubmitType::class)
            ->add('cancel', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('delete')->isClicked()) {
                $entityManager->remove($etudiantPoste);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('etudiant_poste/delete_poste.html.twig', [
            'form' => $form,
        ]);
    }
}
