<?php

namespace App\Controller;

use App\Entity\EtudiantPoste;
use App\Form\EtudiantPosteType;
use App\Form\RegistrationAdminType;
use App\Repository\EtudiantPosteRepository;
use App\Repository\PosteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EtudiantPosteController extends AbstractController
{
    #[Route('/etudiantPoste/{id}', name: 'app_etudiant_poste')]
    public function show(PosteRepository $PosteRepository, EtudiantPosteRepository $etudiantPosteRepository, int $id): Response
    {
        /**if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_poste_info', ['id' => $id]);
        }*/

        $poste = $PosteRepository->find($id);
        $lstEtudiantPoste = $etudiantPosteRepository->findby([]);
        $etudiantPostes = [];
        $etudiants = [];
        foreach ($lstEtudiantPoste as $etudiantPoste) {
            if ($etudiantPoste->getPoste() === $poste) {
                $etudiantPostes[] = $etudiantPoste;
                $etudiants[] = $etudiantPoste->getEtudiant();
            }
        }

        return $this->render('etudiant_poste/show.html.twig', [
            'poste' => $poste,
            'etudiants' => $etudiants,
            'etudiantPostes' => $etudiantPostes,
        ]);
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/etudiantPoste/{id}/delete_poste', name: 'app_etudiant_poste_delete')]
    public function deletePoste(Request $request, EtudiantPoste $etudiantPoste, EntityManagerInterface $entityManager)
    {
        return $this->delete($etudiantPoste, $request, $entityManager, 'app_profil');
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

    /** #[IsGranted('IS_ADMIN')]*/
    #[Route('/etudiantPoste/{id}/deleteAdmin', name: 'app_etudiant_poste_deleteAdmin')]
    public function deletePosteAdmin(Request $request, EtudiantPoste $etudiantPoste, EntityManagerInterface $entityManager): Response
    {
        return $this->delete($etudiantPoste, $request, $entityManager, 'app_etudiant_poste');
    }

    public function delete(EtudiantPoste $etudiantPoste, Request $request, EntityManagerInterface $entityManager, string $route): Response|RedirectResponse
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
            if ('app_etudiant_poste' === $route) {
                return $this->redirectToRoute($route, ['id' => $etudiantPoste->getPoste()->getId()]);
            }

            return $this->redirectToRoute($route);
        }

        return $this->render('etudiant_poste/delete_poste.html.twig', [
            'form' => $form,
        ]);
    }

    /** #[IsGranted('IS_ADMIN')]*/
    #[Route('/etudiantPoste/{id}/updateAdmin', name: 'app_etudiant_poste_updateAdmin')]
    public function updateAdmin(Request $request, EtudiantPoste $etudiantPoste, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RegistrationAdminType::class, $etudiantPoste);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_etudiant_poste', ['id' => $etudiantPoste->getPoste()->getId()]);
        }
        return $this->render('etudiant_poste/update_admin.html.twig', [
            'form' => $form,
            ]);
    }
}
