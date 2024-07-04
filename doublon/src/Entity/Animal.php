<?php

// namespace App\Entity;

// use App\Repository\AnimalRepository;
// use Doctrine\Common\Collections\ArrayCollection;
// use Doctrine\Common\Collections\Collection;
// use Doctrine\DBAL\Types\Types;
// use Doctrine\ORM\Mapping as ORM;
// use Vich\UpLoaderBundle\Mapping\Annotation as Vich;
// use Symfony\Component\HttpFoundation\File\File;
// use vich\UploaderBundle\Entity\File as EmbeddedFile;



// #[ORM\Entity(repositoryClass: AnimalRepository::class)]
// #[Vich\Uploadable]
// class Animal
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column]
//     private ?int $id = null;

//     #[ORM\Column(length: 50)]
//     private ?string $codepuce = null;

//     #[ORM\Column(length: 50)]
//     private ?string $prenom = null;

//     #[ORM\ManyToOne]
//     #[ORM\JoinColumn(nullable: false)]
//     private ?Race $race = null;

//     #[ORM\ManyToOne]
//     #[ORM\JoinColumn(nullable: false)]
//     private ?Habitat $habitat = null;

    
//     #[Vich\UploadableField(mapping: 'animal', fileNameProperty: 'imageName', size: 'imageSize')]
//     private ?File $imageFile = null;

//     #[ORM\Column(nullable: true)]
//     private ?string $imageName= null;

//     #[ORM\Column(nullable: true)]
//     private ?string $imageSize= null;

//     /**
//      * @var Collection<int, Nourriture>
//      */
//     #[ORM\ManyToMany(targetEntity: Nourriture::class, mappedBy: 'animal')]
//     private Collection $nourritures;

//     public function __construct()
//     {
//         $this->nourritures = new ArrayCollection();
//     }

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getCodePuce(): ?string
//     {
//         return $this->codepuce;
//     }

//     public function setCodePuce(string $codepuce): static
//     {
//         $this->codepuce = $codepuce;

//         return $this;
//     }

//     public function getPrenom(): ?string
//     {
//         return $this->prenom;
//     }

//     public function setPrenom(string $prenom): static
//     {
//         $this->prenom = $prenom;

//         return $this;
//     }

//     public function __toString()
//     {
//         return $this->getPrenom();
//     }

//     public function getRace(): ?Race
//     {
//         return $this->race;
//     }

//     public function setRace(?Race $race): static
//     {
//         $this->race = $race;

//         return $this;
//     }

//     public function getHabitat(): ?Habitat
//     {
//         return $this->habitat;
//     }

//     public function setHabitat(?Habitat $habitat): static
//     {
//         $this->habitat = $habitat;

//         return $this;
//     }

//     /**
//      * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
//      */
//     public function setImageFile(?File $imageFile = null): void
//     {
//         $this->image = $imageFile;
//     }

//     public function getImageFile(): ?File
//     {
//         return $this->image;
//     }

//     public function setImageName(?string $imageName): Animal
//     {
//         $this->imageName = $imageName;
//         return $this;
//     }

//     public function getImageName(): ?string
//     {
//         return $this->imageName;
//     }

//     public function setImageSize(?int $imageSize): Animal
//     {
//         $this->imageSize = $imageSize;
//         return $this;
//     }

//     public function getImageSize(): ?string
//     {
//         return $this->imageSize;
//     }


//     /**
//      * @return Collection<int, Nourriture>
//      */
//     public function getNourritures(): Collection
//     {
//         return $this->nourritures;
//     }

//     public function addNourriture(Nourriture $nourriture): static
//     {
//         if (!$this->nourritures->contains($nourriture)) {
//             $this->nourritures->add($nourriture);
//             $nourriture->setType($this);
//         }

//         return $this;
//     }

//     public function removeNourriture(Nourriture $nourriture): static
//     {
//         if ($this->nourritures->removeElement($nourriture)) {
//             if ($nourriture->getType() === $this) {
//                 $nourriture->setType(null);
//             }
//         }

//         return $this;
//     }
//}

<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[Vich\Uploadable]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $codepuce = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Race $race = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Habitat $habitat = null;

    #[Vich\UploadableField(mapping: 'animal', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $image = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    // #[ORM\Column(nullable: true)]
    // private ?int $imageSize = null;

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

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $image
     */
    public function setImage(?File $image = null): void
    {
        $this->image = $image;
    }

    public function getImage(): ?File
    {
        return $this->image;
    }

    public function setImageName(?string $imageName): Animal
    {
        $this->imageName = $imageName;
        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    // public function setImageSize(?int $imageSize): Animal
    // {
    //     $this->imageSize = $imageSize;
    //     return $this;
    // }

    // public function getImageSize(): ?int
    // {
    //     return $this->imageSize;
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
            $nourriture->addAnimal($this);
        }

        return $this;
    }

    public function removeNourriture(Nourriture $nourriture): static
    {
        if ($this->nourritures->removeElement($nourriture)) {
            $nourriture->removeAnimal($this);
        }

        return $this;
    }
}
