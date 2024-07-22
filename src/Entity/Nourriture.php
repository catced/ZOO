<?php

namespace App\Entity;

use App\Repository\NourritureRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NourritureRepository::class)]
class Nourriture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private $quantite;

    #[ORM\Column(type: 'datetime')]
    private $dateHeure;

    // /**
    //  * @var Collection<int, Animal>
    //  */
    #[ORM\ManyToOne(targetEntity: Animal::class, inversedBy: 'nourritures')]
    #[ORM\JoinColumn(nullable: false)]
    private $animal;

    #[ORM\ManyToOne(targetEntity: TypeNourriture::class, inversedBy: 'nourritures')]
    #[ORM\JoinColumn(nullable: false)]
    private $type;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'nourritures')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    // public function __construct()
    // {
    //     $this->animal = new ArrayCollection();
    // }

    // /**
    //  * @var Collection<int, Animal>
    //  */
  
    

    
   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getdateHeure(): ?\DateTimeInterface
    {
        return $this->dateHeure;
    }

    public function setdateHeure(\DateTimeInterface $dateHeure): self
    {
        $this->dateHeure = $dateHeure;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }
    public function getType(): ?TypeNourriture
    {
        return $this->type;
    }

    public function setType(?TypeNourriture $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
    

    //     public function getAnimal(): ?Animal
    // {
    //     return $this->animal;
    // }

    // public function setAnimal(?Animal $animal): self
    // {
    //     $this->animal = $animal;

    //     return $this;
    // }
    // /**
    //  * @return Collection<int, Animal>
    //  */
    // public function getPrenom(): Collection
    // {
    //     return $this->prenom;
    // }

    // public function addPrenom(Animal $prenom): static
    // {
    //     if (!$this->Prenom->contains($prenom)) {
    //         $this->Prenom->add($prenom);
    //     }

    //     return $this;
    // }

    // public function removePrenom(Animal $prenom): static
    // {
    //     $this->Prenom->removeElement($prenom);

    //     return $this;
    // }

    
}
