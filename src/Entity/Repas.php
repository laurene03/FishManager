<?php

namespace App\Entity;

use App\Repository\RepasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepasRepository::class)]
class Repas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    #[ORM\ManyToOne(inversedBy: 'repas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Binome $binome = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getBinome(): ?Binome
    {
        return $this->binome;
    }

    public function setBinome(?Binome $binome): static
    {
        $this->binome = $binome;

        return $this;
    }
}
