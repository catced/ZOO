<?php

namespace App\Entity;

use App\Repository\MetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetierRepository::class)]
class Metier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Poste = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'metier')]
    private Collection $users;

    // #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'metier')]
    // private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

   /* #[ORM\ManyToOne(inversedBy: 'relation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;*/

    /*#[ORM\OneToMany(targetEntity: User::class, mappedBy: 'poste')]
    private Collection $users;*/

    /*public function __construct()
    {
        $this->users = new ArrayCollection();
    }*/
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoste(): ?string
    {
        return $this->Poste;
    }

        public function setPoste(string $Poste): static
    {
        $this->Poste = $Poste;

        return $this;
    }

        /**
         * @return Collection<int, User>
         */
        /*
        public function getUsers(): Collection
        {
            return $this->users;
        }

        public function addUser(User $user): static
        {
            if (!$this->users->contains($user)) {
                $this->users->add($user);
                $user->setPoste($this);
            }

            return $this;
        }

        public function removeUser(User $user): static
        {
            if ($this->users->removeElement($user)) {
                // set the owning side to null (unless already changed)
                if ($user->getPoste() === $this) {
                    $user->setPoste(null);
                }
            }

            return $this;
        }*/
/*
        public function getUser(): ?User
        {
            return $this->user;
        }

        public function setUser(?User $user): static
        {
            $this->user = $user;

            return $this;
        }*/

/**
 * @return Collection<int, User>
 */
public function getUsers(): Collection
{
    return $this->users;
}

// public function addUser(User $user): static
// {
//     if (!$this->users->contains($user)) {
//         $this->users->add($user);
//         $user->setMetier($this);
//     }

//     return $this;
// }

// public function removeUser(User $user): static
// {
//     if ($this->users->removeElement($user)) {
//         // set the owning side to null (unless already changed)
//         if ($user->getMetier() === $this) {
//             $user->setMetier(null);
//         }
//     }

//     return $this;
// }
public function __toString() {
    return $this->Poste;
}

public function addUser(User $user): static
{
    if (!$this->users->contains($user)) {
        $this->users->add($user);
        $user->setMetier($this);
    }

    return $this;
}

public function removeUser(User $user): static
{
    if ($this->users->removeElement($user)) {
        // set the owning side to null (unless already changed)
        if ($user->getMetier() === $this) {
            $user->setMetier(null);
        }
    }

    return $this;
}
}
