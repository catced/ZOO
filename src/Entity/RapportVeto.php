<?php

namespace App\Entity;

use App\Repository\RapportVetoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RapportVeto::class)]
class RapportVeto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $detailEtatAnimal = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datepassage = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeNourriture $typenourriture = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $veterinaire = null;

   


    #[ORM\Column]
    private ?int $grammage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetailEtatAnimal(): ?string
    {
        return $this->detailEtatAnimal;
    }

    public function setDetailEtatAnimal(string $detailEtatAnimal): self
    {
        $this->detailEtatAnimal = $detailEtatAnimal;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDatepassage(): ?\DateTimeInterface
    {
        return $this->datepassage;
    }

    public function setDatepassage(\DateTimeInterface $datepassage): static
    {
        $this->datepassage = $datepassage;

        return $this;
    }
    // public function getType(): ?string 
    // {
    //     return $this->type;
    // }

    // public function setType(string $type): static 
    // {
    //     $this->type = $type;
    //     return $this;
    // }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function getTypeNourriture(): ?TypeNourriture
    {
        return $this->typenourriture;
    }

    public function setTypeNourriture(?TypeNourriture $typenourriture): self
    {
        $this->typenourriture = $typenourriture;

        return $this;
    }

    public function getGrammage(): ?int
    {
        return $this->grammage;
    }

    public function setGrammage(int $grammage): static
    {
        $this->grammage = $grammage;

        return $this;
    }

    public function getVeterinaire(): ?User
    {
        return $this->veterinaire;
    }

    public function setVeterinaire(?User $veterinaire): self
    {
        $this->veterinaire = $veterinaire;

        return $this;
    }
    
    public function getTypeNourritureId(): ?int
    {
        return $this->typenourriture ? $this->typenourriture->getId() : null;
    }

    

    
}
