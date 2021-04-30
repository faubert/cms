<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthDate;

    /**
     * @ORM\OneToOne(targetEntity=Contact::class, inversedBy="profil", cascade={"persist", "remove"})
     */
    private $contact;

    /**
     * @ORM\OneToMany(targetEntity=Adress::class, mappedBy="profil")
     */
    private $adress;

    public function __construct()
    {
        $this->adress = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return Collection|Adress[]
     */
    public function getAdress(): Collection
    {
        return $this->adress;
    }

    public function addAdress(Adress $adress): self
    {
        if (!$this->adress->contains($adress)) {
            $this->adress[] = $adress;
            $adress->setProfil($this);
        }

        return $this;
    }

    public function removeAdress(Adress $adress): self
    {
        if ($this->adress->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getProfil() === $this) {
                $adress->setProfil(null);
            }
        }

        return $this;
    }
}
