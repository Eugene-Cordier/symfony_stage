<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Repository\PosteRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextEditorField::new('description'),
            AssociationField::new('postes')->setFormTypeOptions(
                [
                    'choice_label' => 'label',
                    'query_builder' => function (PosteRepository $posteRepository) {
                        return $posteRepository->createQueryBuilder('p')
                            ;
                    },
                ]
            )->formatValue(function ($value) {
                $count = 0;
                foreach ($value as $poste) {
                    ++$count;
                }

                return $count;
            }),
        ];
    }
}
