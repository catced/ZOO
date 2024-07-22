<?php

namespace App\Entity;

use App\Repository\HabitatRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;


#[ORM\Entity(repositoryClass: HabitatRepository::class)]
#[Vich\Uploadable]
class Habitat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'habitat_images', fileNameProperty: 'image', size: 'size')]
    private ?File $file = null;
    // /**
    //  * @Vich\UploadableField(mapping="habitat_images", fileNameProperty="image", size="size")
    //  * @var File|null
    //  */
    // private ?File $file = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom = null;

    #[ORM\Column(length: 50)]
    private ?string $Description = null;

    #[ORM\Column(length: 300)]
    private ?string $CommentaireHabitat = null;

   

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;  

    #[ORM\Column(nullable: true)]
    private ?int $size = null;  
    
     
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;  

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file = null): self
    {
        $this->file = $file;

        // If there is an uploaded file, update the updatedAt field to trigger the upload.
        if ($file) {
            $this->updatedAt = new \DateTimeImmutable('now');
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function __toString() {
        return $this->Nom;
    }
}
