<?php

namespace App\Controller\Admin;

use App\Entity\EtudiantPoste;
use App\Repository\EtudiantRepository;
use App\Repository\PosteRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EtudiantPosteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EtudiantPoste::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('statut'),
            AssociationField::new('etudiant')->setFormTypeOptions(
                [
                    'choice_label' => 'login',
                    'query_builder' => function (EtudiantRepository $etudiantRepository) {
                        return $etudiantRepository->createQueryBuilder('e')
                                ->orderBy('e.login', 'ASC');
                    },
                ]
            )->formatValue(function ($value) {
                return $value?->getLogin();
            }),
            AssociationField::new('Poste')->setFormTypeOptions(
                [
                    'choice_label' => 'label',
                    'query_builder' => function (PosteRepository $posteRepository) {
                        return $posteRepository->createQueryBuilder('p')
                            ->orderBy('p.label', 'ASC');
                    },
                ]
            )->formatValue(function ($value) {
                return $value?->getLabel();
            }),
        ];
    }
}
