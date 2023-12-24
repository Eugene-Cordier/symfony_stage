<?php

namespace App\Controller;

use App\Entity\EtudiantPoste;
use App\Form\EtudiantPosteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EtudiantPosteController extends AbstractController
{
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
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

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/etudiantPoste/{id}/update_cv', name: 'app_etudiant_poste_update_cv')]
    public function updateCv(Request $request, EtudiantPoste $etudiantPoste, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EtudiantPosteType::class, $etudiantPoste);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cvFile = $form['cv']->getData();

            if ($cvFile instanceof UploadedFile) {
                $etudiantPoste->setCv($cvFile->getContent());
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('etudiant_poste/update_cv.html.twig', [
            'form' => $form,
        ]);
    }
}
