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

    #[Vich\UploadableField(mapping: 'animal', fileNameProperty: 'name', size: 'size')]
    private ?File $file = null;

    #[ORM\Column(length: 50)]
    private ?string $codepuce = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $consultation = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    // #[ORM\Column(length: 255, nullable: true)]
    // private ?string $file = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;  

    #[ORM\Column(nullable: true)]
    private ?int $size = null;  

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;  

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Race $race = null;


//   /**
//      * @Vich\UploadableField(mapping="animal_images", fileNameProperty="imageName")
//      * @var File|null
//      */
//     private $imageFile;

//     /**
//      * @ORM\Column(type="string", length=255, nullable=true)
//      */
//     private $imageName;

    // #[ORM\Column(type: 'string')]
    // private ?string $imageName = null;    
    
    // #[ORM\Column(type: 'integer')]
    // private ?int $imageSize = null;  
    // #[ORM\Embedded(class: EmbeddedFile::class)]
    // private ?EmbeddedFile $image = null;
    // #[ORM\Column(length: 255, nullable: true)]
    // private ?string $image = null;

    // #[ORM\Column(length: 255)]
    // private ?string $imageName = null;

    // #[ORM\Column(integer: 10)]
    // private ?integer $imageSize = null;

    // #[Vich\UploadableField(mapping: 'animal_images', fileNameProperty: 'imageName', size: 'imageSize')]
    // private ?File $imageFile = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Habitat $habitat = null;

    /**
     * @var Collection<int, Nourriture>
     */
    #[ORM\ManyToMany(targetEntity: Nourriture::class, mappedBy: 'animal')]
    private Collection $nourritures;





    public function __construct()
    {
        $this->nourritures = new ArrayCollection();
    }

  
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodePuce(): ?string
    {
        return $this->codepuce;
    }

    public function setCodePuce(string $codepuce): static
    {
        $this->codepuce = $codepuce;

        return $this;
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

    // public function setImageFile(?File $imageFile = null): void
    // {
    //     $this->imageFile = $imageFile;
    // }

    // public function getImageFile(): ?File
    // {
    //     return $this->imageFile;
    // }

    // public function setImageName(?string $imageName): void
    // {
    //     $this->imageName = $imageName;
    // }

    // public function getImageName(): ?string
    // {
    //     return $this->imageName;
    // }
    //  /**
    //  * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $image
    //  */
    // public function setImage(?File $image = null): void
    // {
    //     $this->image = $image;

    //     if ($this->image instanceof UploadedFile) {
          
    //     }
    // }

    // public function getImage(): ?File
    // {
    //     return $this->image;
    // }

    // public function setImageName(?File $imageName): self
    // {
    //     $this->imageName = $imageName;
    // }

    // public function getImageName(): ?string
    // {
    //     return $this->imageName;
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

    // public function getImage(): ?string
    // {
    //     return $this->image;
    // }

    // public function setImage(?string $image): static
    // {
    //     $this->image = $image;

    //     return $this;
    // }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
