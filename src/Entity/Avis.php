<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentaire = null;

    #[ORM\Column(nullable: true)]
    private ?bool $estVisible = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $creele = null;

    private $createdAt;

    public function __construct()
    {
        $this->creele = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function GetEstVisible(): ?bool
    {
        return $this->estVisible;
    }

    public function setEstVisible(?bool $estVisible): static
    {
        $this->estVisible = $estVisible;

        return $this;
    }

    public function getCreele(): ?\DateTimeInterface
    {
        return $this->creele;
    }

    public function setCreele(\DateTimeInterface $creele): static
    {
        $this->creele = $creele;

        return $this;
    }

   
  
}
