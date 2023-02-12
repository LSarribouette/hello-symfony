<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull(message: "Renseigne un titre pour le film !")]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Assert\Range(
        notInRangeMessage: "Le premier film est sorti en 1895 et nous sommes en 2023. Choisis une date dans cet intervalle :)",
        min: 1895, max: 2023
    )]
    #[ORM\Column(nullable: true)]
    private ?int $releaseYear = null;

    #[ORM\Column(nullable: true)]
    private ?bool $wasSeen = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    private ?Country $country = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseYear(): ?int
    {
        return $this->releaseYear;
    }

    public function setReleaseYear(?int $releaseYear): self
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    public function isWasSeen(): ?bool
    {
        return $this->wasSeen;
    }

    public function setWasSeen(?bool $wasSeen): self
    {
        $this->wasSeen = $wasSeen;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }
}
