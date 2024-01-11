<?php

namespace App\Controller\Admin;

use App\Entity\Recruteur;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RecruteurCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return Recruteur::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('prenom'),
            TextField::new('nom'),
            TextField::new('login'),
            EmailField::new('email'),
            TextField::new('password')
                ->onlyOnForms()
                ->setFormType(PasswordType::class)
                ->setFormTypeOptions([
                    'required' => false,
                    'empty_data' => '',
                    'attr' => ['autocomplete' => 'new-password'],
                ]),
        ];
    }

    public function setUserPassword($entityInstance): void
    {
        $password = $this->getContext()->getRequest()->get('Recruteur')['password'];
        if (!empty($password) || $password !== null) {
            $entityInstance->setPassword($this->passwordHasher->hashPassword($entityInstance, $entityInstance->getPassword()));
        }
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setUserPassword($entityInstance);
        parent::updateEntity($entityManager, $entityInstance);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setUserPassword($entityInstance);
        parent::persistEntity($entityManager, $entityInstance);
    }
}
