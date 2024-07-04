<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $Image_id = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $Image;

    public function getImage_Id(): ?int
    {
        return $this->Image_id;
    }

    public function getImage()
    {
        return $this->Image;
    }

    public function setImage($Image): static
    {
        $this->Image = $Image;

        return $this;
    }
}
