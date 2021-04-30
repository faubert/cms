<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $mobilePhone;

    /**
     * @ORM\OneToOne(targetEntity=Profil::class, mappedBy="contact", cascade={"persist", "remove"})
     */
    private $profil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(?string $mobilePhone): self
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        // unset the owning side of the relation if necessary
        if ($profil === null && $this->profil !== null) {
            $this->profil->setContact(null);
        }

        // set the owning side of the relation if necessary
        if ($profil !== null && $profil->getContact() !== $this) {
            $profil->setContact($this);
        }

        $this->profil = $profil;

        return $this;
    }
}
