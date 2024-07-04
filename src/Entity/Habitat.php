<?php

namespace App\Entity;

use App\Repository\HabitatRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: HabitatRepository::class)]
#[Vich\Uploadable]
class Habitat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $CodeHab = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom = null;

    #[ORM\Column(length: 50)]
    private ?string $Description = null;

    #[ORM\Column(length: 100)]
    private ?string $CommentaireHabitat = null;

    // #[Vich\UploadableField(mapping:'habitat_images', filenameProperty: 'imageName')]
    // private ?File $imageFile = null;

    #[ORM\Column(type: 'string')]
    private ?string $imageName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeHab(): ?string
    {
        return $this->CodeHab;
    }

    public function setCodeHab(string $CodeHab): static
    {
        $this->CodeHab = $CodeHab;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCommentaireHabitat(): ?string
    {
        return $this->CommentaireHabitat;
    }

    public function setCommentaireHabitat(string $CommentaireHabitat): static
    {
        $this->CommentaireHabitat = $CommentaireHabitat;

        return $this;
    }

    

    public function __toString() {
        return $this->Nom;
    }
}
