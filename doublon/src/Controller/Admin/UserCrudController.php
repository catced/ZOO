<?php

// namespace App\Controller\Admin;

// use App\Entity\User;
// use App\Entity\Metier;
// use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
// use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
// use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
// use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
// use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud, KeyValueStore};
// use Symfony\Component\Form\Extension\Core\Type\{PasswordType, RepeatedType};
// use Symfony\Component\Form\{FormBuilderInterface, FormEvent, FormEvents};
// use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
// use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
// use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
// use App\Service\EmailService;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;


// class UserCrudController extends AbstractCrudController
// {
  
//     public function __construct(
//         public UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, EmailService $emailService
//         ) {}
        
//     public static function getEntityFqcn(): string
//     {
//         return User::class;
//     }

//     public function configureActions(Actions $actions): Actions
//     {
//         return $actions
//             ->add(Crud::PAGE_EDIT, Action::INDEX)
//             ->add(Crud::PAGE_INDEX, Action::DETAIL)
//             ->add(Crud::PAGE_EDIT, Action::DETAIL)
//             ;
//     }
    
//     public function configureFields(string $pageName): iterable
//     {
//         $fields = [
//             IdField::new('i)->hideOnForm(),
//             EmailField::new('Email','Adresse mail'),
//             TextField::new('Username','Nom utilisateur'),
       
//             ChoiceField::new('roles')
//                 ->setChoices(['Administrateur' => 'ROLE_ADMIN', 'Employe' => 'ROLE_EMPLOYE','Vétérinaire' => 'ROLE_VETERINAIRE'])
//                 ->allowMultipleChoices('false')
//                 ->renderExpanded(),
       
//             AssociationField::new('metier'),
//             AssociationField::new('service'),
//         ];
        
//         $password = TextField::new('password')
//             ->setFormType(RepeatedType::class)
//             ->setFormTypeOptions([
//                 'type' => PasswordType::class,
//                 'first_options' => ['label' => 'Mot de passe'],
//                 'second_options' => ['label' => 'Confirmation du mot de passe'],
//                 'mapped' => false,
//             ])
//             ->setRequired($pageName === Crud::PAGE_NEW)
//             ->onlyOnForms()
//             ;
//         $fields[] = $password;
       
//         return $fields;
    
//     }

//     public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
//     {
//         $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
//         return $this->addPasswordEventListener($formBuilder);
//     }

//     public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
//     {
//         $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
//         return $this->addPasswordEventListener($formBuilder);
//     }

//     private function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
//     {
//         return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->hashPassword());
        
//     }

//     private function hashPassword() {
//         // return function($event) {
//         //     $form = $event->getForm();
//         //     if (!$form->isValid()) {
//         //         return;
//         //     }
//         //     $password = $form->get('password')->getData();
//         //     if ($password === null) {
//         //         return;
//         //     }

//         //     $hash = $this->userPasswordHasher->hashPassword($this->getUser(), $password);
//         //     $form->getData()->setPassword($hash);
//         // };
//         return function(FormEvent $event) {
//             $form = $event->getForm();
//             $user = $form->getData();
//             $password = $form->get('password')->getData();

//             if ($password) {
//                 $user->setPassword($this->userPasswordHasher->hashPassword($user, $password));
//             }
//         };
//     }
    
    
// }
namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Metier;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud, KeyValueStore};
use Symfony\Component\Form\Extension\Core\Type\{PasswordType, RepeatedType};
use Symfony\Component\Form\{FormBuilderInterface, FormEvent, FormEvents};
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use App\Service\EmailService;
use Doctrine\ORM\EntityManagerInterface;

class UserCrudController extends AbstractCrudController
{
    private $userPasswordHasher;
    private $entityManager;
    private $emailService;

    public function __construct(
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        EmailService $emailService
    ) {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->entityManager = $entityManager;
        $this->emailService = $emailService;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_EDIT, Action::INDEX)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id')->hideOnForm(),
            EmailField::new('Email', 'Adresse mail'),
            TextField::new('Username', 'Nom utilisateur'),
            ChoiceField::new('roles')
                ->setChoices(['Administrateur' => 'ROLE_ADMIN', 'Employé' => 'ROLE_EMPLOYE', 'Vétérinaire' => 'ROLE_VETERINAIRE'])
                ->allowMultipleChoices(true)
                ->renderExpanded(),
            AssociationField::new('metier'),
            AssociationField::new('service'),
        ];

        $password = TextField::new('password')
            ->setFormType(RepeatedType::class)
            ->setFormTypeOptions([
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmation du mot de passe'],
                'mapped' => false,
            ])
            ->setRequired($pageName === Crud::PAGE_NEW)
            ->onlyOnForms();
        $fields[] = $password;

        return $fields;
    }

    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    private function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
        $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->hashPassword());
        $formBuilder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) {
            $form = $event->getForm();
            $user = $form->getData();

            // Envoyer un email après la création de l'utilisateur
            if ($form->isSubmitted() && $form->isValid() && $user instanceof User) {
                $this->emailService->sendUserCreationEmail($user->getEmail(), $user->getUsername());
            }
        });

        return $formBuilder;
    }

    private function hashPassword()
    {
        return function(FormEvent $event) {
            $form = $event->getForm();
            $user = $form->getData();
            $password = $form->get('password')->getData();

            if ($password) {
                $user->setPassword($this->userPasswordHasher->hashPassword($user, $password));
            }
        };
    }

   
} 