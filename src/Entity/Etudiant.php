<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\OneToOne(mappedBy: 'etudiant1', cascade: ['persist', 'remove'])]
    private ?Binome $binome = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getBinome(): ?Binome
    {
        return $this->binome;
    }

    public function setBinome(?Binome $binome): static
    {
        // unset the owning side of the relation if necessary
        if ($binome === null && $this->binome !== null) {
            $this->binome->setEtudiant1(null);
        }

        // set the owning side of the relation if necessary
        if ($binome !== null && $binome->getEtudiant1() !== $this) {
            $binome->setEtudiant1($this);
        }

        $this->binome = $binome;

        return $this;
    }
}
