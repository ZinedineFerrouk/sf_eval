<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez saisir un nom pour le show")]
    #[Assert\Length(
        min: 2,
        max: 58,
        minMessage:'Veuillez saisir un nom de salle avec plus de caractères',
        maxMessage:'Veuillez saisir un nom de salle avec moins de caractères',
    )]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez saisir un type pour le show")]
    #[Assert\Length(
        min: 2,
        max: 58,
        minMessage:'Veuillez saisir un type avec plus de caractères',
        maxMessage:'Veuillez saisir un type avec moins de caractères',
    )]
    private ?string $type = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez saisir un studio pour le show")]
    #[Assert\Length(
        min: 2,
        max: 58,
        minMessage:'Veuillez saisir un nom studio avec plus de caractères',
        maxMessage:'Veuillez saisir un nom studio avec moins de caractères',
    )]
    private ?string $studio = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez saisir un genre pour le show")]
    #[Assert\Length(
        min: 2,
        max: 58,
        minMessage:'Veuillez saisir un genre avec plus de caractères',
        maxMessage:'Veuillez saisir un genre avec moins de caractères',
    )]
    private ?string $genre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Veuillez saisir une valeur pour le type de show")]
    #[Assert\Length(
        min: 2,
        max: 58,
        minMessage:'Veuillez saisir un type de show avec plus de caractères',
        maxMessage:'Veuillez saisir un type de show avec moins de caractères',
    )]
    private ?string $synopsis = null;

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

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getStudio(): ?string
    {
        return $this->studio;
    }

    public function setStudio(string $studio): self
    {
        $this->studio = $studio;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }
}
