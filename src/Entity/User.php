<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Beer::class, mappedBy="userId")
     */
    private $beers;

    /**
     * @ORM\OneToMany(targetEntity=BeerScoreComment::class, mappedBy="user")
     */
    private $Id;

    public function __construct()
    {
        $this->beers = new ArrayCollection();
        $this->Id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Beer[]
     */
    public function getBeers(): Collection
    {
        return $this->beers;
    }

    public function addBeer(Beer $beer): self
    {
        if (!$this->beers->contains($beer)) {
            $this->beers[] = $beer;
            $beer->setUserId($this);
        }

        return $this;
    }

    public function removeBeer(Beer $beer): self
    {
        if ($this->beers->contains($beer)) {
            $this->beers->removeElement($beer);
            // set the owning side to null (unless already changed)
            if ($beer->getUserId() === $this) {
                $beer->setUserId(null);
            }
        }

        return $this;
    }

    public function addId(BeerScoreComment $id): self
    {
        if (!$this->Id->contains($id)) {
            $this->Id[] = $id;
            $id->setUser($this);
        }

        return $this;
    }

    public function removeId(BeerScoreComment $id): self
    {
        if ($this->Id->contains($id)) {
            $this->Id->removeElement($id);
            // set the owning side to null (unless already changed)
            if ($id->getUser() === $this) {
                $id->setUser(null);
            }
        }

        return $this;
    }
}
