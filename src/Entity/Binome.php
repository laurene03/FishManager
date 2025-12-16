<?php

namespace App\Entity;

use App\Repository\BinomeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BinomeRepository::class)]
class Binome
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'binome', cascade: ['persist', 'remove'])]
    private ?Etudiant $etudiant1 = null;

    #[ORM\OneToOne(inversedBy: 'binome', cascade: ['persist', 'remove'])]
    private ?Etudiant $etudiant2 = null;

    /**
     * @var Collection<int, Repas>
     */
    #[ORM\OneToMany(targetEntity: Repas::class, mappedBy: 'binome')]
    private Collection $repas;

    /**
     * @var Collection<int, Releve>
     */
    #[ORM\OneToMany(targetEntity: Releve::class, mappedBy: 'binome')]
    private Collection $releves;

    public function __construct()
    {
        $this->repas = new ArrayCollection();
        $this->releves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtudiant1(): ?Etudiant
    {
        return $this->etudiant1;
    }

    public function setEtudiant1(?Etudiant $etudiant1): static
    {
        $this->etudiant1 = $etudiant1;

        return $this;
    }

    public function getEtudiant2(): ?Etudiant
    {
        return $this->etudiant2;
    }

    public function setEtudiant2(?Etudiant $etudiant2): static
    {
        $this->etudiant2 = $etudiant2;

        return $this;
    }

    /**
     * @return Collection<int, Repas>
     */
    public function getRepas(): Collection
    {
        return $this->repas;
    }

    public function addRepa(Repas $repa): static
    {
        if (!$this->repas->contains($repa)) {
            $this->repas->add($repa);
            $repa->setBinome($this);
        }

        return $this;
    }

    public function removeRepa(Repas $repa): static
    {
        if ($this->repas->removeElement($repa)) {
            // set the owning side to null (unless already changed)
            if ($repa->getBinome() === $this) {
                $repa->setBinome(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Releve>
     */
    public function getReleves(): Collection
    {
        return $this->releves;
    }

    public function addRelefe(Releve $relefe): static
    {
        if (!$this->releves->contains($relefe)) {
            $this->releves->add($relefe);
            $relefe->setBinome($this);
        }

        return $this;
    }

    public function removeRelefe(Releve $relefe): static
    {
        if ($this->releves->removeElement($relefe)) {
            // set the owning side to null (unless already changed)
            if ($relefe->getBinome() === $this) {
                $relefe->setBinome(null);
            }
        }

        return $this;
    }
}
