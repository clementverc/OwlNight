<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartnerRepository")
 */
class Partner
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PartnerOffre", mappedBy="partner")
     */
    private $partnerOffres;

    public function __construct()
    {
        $this->partnerOffres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|PartnerOffre[]
     */
    public function getPartnerOffres(): Collection
    {
        return $this->partnerOffres;
    }

    public function addPartnerOffre(PartnerOffre $partnerOffre): self
    {
        if (!$this->partnerOffres->contains($partnerOffre)) {
            $this->partnerOffres[] = $partnerOffre;
            $partnerOffre->setPartner($this);
        }

        return $this;
    }

    public function removePartnerOffre(PartnerOffre $partnerOffre): self
    {
        if ($this->partnerOffres->contains($partnerOffre)) {
            $this->partnerOffres->removeElement($partnerOffre);
            // set the owning side to null (unless already changed)
            if ($partnerOffre->getPartner() === $this) {
                $partnerOffre->setPartner(null);
            }
        }

        return $this;
    }
}
