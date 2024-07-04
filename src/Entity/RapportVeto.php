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

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datepassage = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null; 
    
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Nourriture $nourriture = null;

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

    public function setDetailEtatAnimal(string $detailEtatAnimal): static
    {
        $this->detailEtatAnimal = $detailEtatAnimal;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
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
    public function getType(): ?string 
    {
        return $this->type;
    }

    public function setType(string $type): static 
    {
        $this->type = $type;
        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function getNourriture(): ?Nourriture
    {
        return $this->nourriture;
    }

    public function setNourriture(?Nourriture $nourriture): static
    {
        $this->nourriture = $nourriture;

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
}
