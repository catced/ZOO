<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;


#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[Vich\Uploadable]
class Animal

{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'animal_images', fileNameProperty: 'image', size: 'size')]
    private ?File $file = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $consultation = 0;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;  

    #[ORM\Column(nullable: true)]
    private ?int $size = null;  

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;  

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Race $race = null;


    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Habitat $habitat = null;

    /**
     * @var Collection<int, Nourriture>
     */
    #[ORM\ManyToMany(targetEntity: Nourriture::class, mappedBy: 'animal')]
    private Collection $nourritures;

    // #[ORM\ManyToOne]
    // private ?RapportVeto $rapportsVeto = null;

  



    public function __construct()
    {
        $this->nourritures = new ArrayCollection();
       // $this->rapportsVeto = new ArrayCollection();
    }

  
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function __toString()
    {
        return $this->getPrenom();
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): static
    {
        $this->race = $race;

        return $this;
    }

    public function getHabitat(): ?Habitat
    {
        return $this->habitat;
    }

    public function setHabitat(?Habitat $habitat): static
    {
        $this->habitat = $habitat;

        return $this;
    }

    public function setFile(?File $file): void
    {
        $this->file = $file;

        if  (null!== $file){
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getFile(): ?File
    {
        return $this->file;
       
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setSize(?int $size): void
    {
        $this->size = $size;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    // public function getRapportsVeto(): Collection
    // {
    //     return $this->rapportsVeto;
    // }

    // public function addRapportVeto(RapportVeto $rapportVeto): self
    // {
    //     if (!$this->rapportsVeto->contains($rapportVeto)) {
    //         $this->rapportsVeto[] = $rapportVeto;
    //         $rapportVeto->setAnimal($this);
    //     }

    //     return $this;
    // }

    // public function removeRapportVeto(RapportVeto $rapportVeto): self
    // {
    //     if ($this->rapportsVeto->removeElement($rapportVeto)) {
    //         // set the owning side to null (unless already changed)
    //         if ($rapportVeto->getAnimal() === $this) {
    //             $rapportVeto->setAnimal(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, Nourriture>
     */
    public function getNourritures(): Collection
    {
        return $this->nourritures;
    }

    public function addNourriture(Nourriture $nourriture): static
    {
        if (!$this->nourritures->contains($nourriture)) {
            $this->nourritures->add($nourriture);
            $nourriture->setType($this);
        }

        return $this;
    }

    public function removeNourriture(Nourriture $nourriture): static
    {
        if ($this->nourritures->removeElement($nourriture)) {
            if ($nourriture->getType() === $this) {
                $nourriture->setType(null);
            }
        }

        return $this;
    }

    public function getConsultation(): ?int
    {
        return $this->consultation;
    }

    public function setConsultation(int $consultation): static
    {
        $this->consultation = $consultation;

        return $this;
    }

    public function incrementConsultation(): self
    {
        $this->consultation++;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

 
}
