<?php

namespace App\Entity;

use App\Repository\ReleveRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReleveRepository::class)]
class Releve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 1)]
    private ?string $temperature = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?string $CO2dissous = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 1)]
    private ?string $pH4 = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?string $gH = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?string $kH = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 2)]
    private ?string $chlore = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 2)]
    private ?string $nitrite = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 2)]
    private ?string $nitrate = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $remarque = null;

    #[ORM\ManyToOne(inversedBy: 'releves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Binome $binome = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemperature(): ?string
    {
        return $this->temperature;
    }

    public function setTemperature(string $temperature): static
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getCO2dissous(): ?string
    {
        return $this->CO2dissous;
    }

    public function setCO2dissous(string $CO2dissous): static
    {
        $this->CO2dissous = $CO2dissous;

        return $this;
    }

    public function getPH4(): ?string
    {
        return $this->pH4;
    }

    public function setPH4(string $pH4): static
    {
        $this->pH4 = $pH4;

        return $this;
    }

    public function getGH(): ?string
    {
        return $this->gH;
    }

    public function setGH(string $gH): static
    {
        $this->gH = $gH;

        return $this;
    }

    public function getKH(): ?string
    {
        return $this->kH;
    }

    public function setKH(string $kH): static
    {
        $this->kH = $kH;

        return $this;
    }

    public function getChlore(): ?string
    {
        return $this->chlore;
    }

    public function setChlore(string $chlore): static
    {
        $this->chlore = $chlore;

        return $this;
    }

    public function getNitrite(): ?string
    {
        return $this->nitrite;
    }

    public function setNitrite(string $nitrite): static
    {
        $this->nitrite = $nitrite;

        return $this;
    }

    public function getNitrate(): ?string
    {
        return $this->nitrate;
    }

    public function setNitrate(string $nitrate): static
    {
        $this->nitrate = $nitrate;

        return $this;
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

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): static
    {
        $this->remarque = $remarque;

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
