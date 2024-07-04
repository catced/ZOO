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

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\Column(type: 'integer')]
    private $quantite;

    #[ORM\Column(type: 'datetime')]
    private $dateHeure;

    // /**
    //  * @var Collection<int, Animal>
    //  */
    // #[ORM\ManyToOne(targetEntity: Animal::class, inversedBy: 'nourritures')]
    // #[ORM\JoinColumn(nullable: false)]
    // private $animal;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
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

    // public function getAnimal(): ?Animal
    // {
    //     return $this->animal;
    // }

    // public function setAnimal(?Animal $animal): self
    // {
    //     $this->animal = $animal;

    //     return $this;
    // }

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
