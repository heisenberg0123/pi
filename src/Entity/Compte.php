<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteRepository::class)]
class Compte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $Status = null;

    #[ORM\Column]
    private ?int $Solde = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\OneToMany(targetEntity: Pret::class, mappedBy: 'PretId')]
    private Collection $prets;

    public function __construct()
    {
        $this->prets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isStatus(): ?bool
    {
        return $this->Status;
    }

    public function setStatus(bool $Status): static
    {
        $this->Status = $Status;

        return $this;
    }

    public function getSolde(): ?int
    {
        return $this->Solde;
    }

    public function setSolde(int $Solde): static
    {
        $this->Solde = $Solde;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    /**
     * @return Collection<int, Pret>
     */
    public function getPrets(): Collection
    {
        return $this->prets;
    }

    public function addPret(Pret $pret): static
    {
        if (!$this->prets->contains($pret)) {
            $this->prets->add($pret);
            $pret->setPretId($this);
        }

        return $this;
    }

    public function removePret(Pret $pret): static
    {
        if ($this->prets->removeElement($pret)) {
            // set the owning side to null (unless already changed)
            if ($pret->getPretId() === $this) {
                $pret->setPretId(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getId();
    }
}
