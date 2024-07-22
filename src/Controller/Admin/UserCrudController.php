<?php

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
// use App\Service\EmailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UserCrudController extends AbstractCrudController
{
    private $userPasswordHasher;
    private $entityManager;
    // private $emailService;
    private $mailer;
    

    public function __construct(
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        // EmailService $emailService
        MailerInterface $mailer
    ) {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->entityManager = $entityManager;
        // $this->emailService = $emailService;
        $this->mailer = $mailer;
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
            IdField::new('Id')->hideOnForm(),
            EmailField::new('Email', 'Adresse mail'),
            TextField::new('Username', 'Nom utilisateur'),
            ChoiceField::new('roles')
                ->setChoices(['Employé' => 'ROLE_EMPLOYE', 'Vétérinaire' => 'ROLE_VETERINAIRE'])
                ->allowMultipleChoices(true)
                ->renderExpanded(),
            AssociationField::new('metier'),
          //  AssociationField::new('service'),
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

            if ($form->isValid() && $user instanceof User) {
                $this->EnvoiMailUser($user);
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

    private function EnvoiMailUser(User $user)
    {
        $email = (new Email())
            ->from('jose@gmail.com')
            ->to($user->getEmail())
            ->subject('Bienvenue sur notre site !')
            ->html("Bonjour {$user->getUsername()},<br><br>Bienvenue sur notre site. Je viens de créer votre compte pour accéder à votre espace. Venez me voir afin que je vous indique le mot de passe.<br><br>Cordialement,<br> José.");

        try {
            $this->mailer->send($email);
        } catch (\Exception $e) {
            // Log the error message
            error_log('Email not sent: ' . $e->getMessage());
        }
        
    }
} 