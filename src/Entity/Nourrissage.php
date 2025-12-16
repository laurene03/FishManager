<?php

namespace App\Entity;

use App\Repository\NourrissageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NourrissageRepository::class)]
class Nourrissage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Repas $repas = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRepas(): ?Repas
    {
        return $this->repas;
    }

    public function setRepas(?Repas $repas): static
    {
        $this->repas = $repas;

        return $this;
    }
}
