<?php

namespace App\Entity;

use App\Repository\HoraireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoraireRepository::class)]
class Horaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $CodeJour = null;

    #[ORM\Column(length: 20)]
    private ?string $Jour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Matin_Deb = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Matin_Fin = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Am_Deb = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Am_Fin = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Est_Ferme = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeJour(): ?string
    {
        return $this->CodeJour;
    }

    public function setCodeJour(string $CodeJour): static
    {
        $this->CodeJour = $CodeJour;

        return $this;
    }

    public function getJour(): ?string
    {
        return $this->Jour;
    }

    public function setJour(string $Jour): static
    {
        $this->Jour = $Jour;

        return $this;
    }

    public function getMatinDeb(): ?\DateTimeInterface
    {
        return $this->Matin_Deb;
    }

    public function setMatinDeb(\DateTimeInterface $MatinDeb): static
    {
        $this->Matin_Deb = $MatinDeb;

        return $this;
    }

    public function getMatinFin(): ?\DateTimeInterface
    {
        return $this->Matin_Fin;
    }

    public function setMatinFin(?\DateTimeInterface $MatinFin): static
    {
        $this->Matin_Fin = $MatinFin;

        return $this;
    }

    public function getAmDeb(): ?\DateTimeInterface
    {
        return $this->Am_Deb;
    }

    public function setAmDeb(?\DateTimeInterface $AmDeb): static
    {
        $this->Am_Deb = $AmDeb;

        return $this;
    }

    public function getAmFin(): ?\DateTimeInterface
    {
        return $this->Am_Fin;
    }

    public function setAmFin(\DateTimeInterface $AmFin): static
    {
        $this->Am_Fin = $AmFin;

        return $this;
    }

    public function GetEstFerme(): ?bool   /*is*/
    {
        return $this->Est_Ferme;
    }

    public function setEstFerme(?bool $Est_Ferme): static
    {
        $this->Est_Ferme = $Est_Ferme;

        return $this;
    }
}
