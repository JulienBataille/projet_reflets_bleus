<?php

namespace App\Entity;

use App\Repository\NewsletterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsletterRepository::class)]
class Newsletter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email;

    #[ORM\Column(type: 'boolean')]
    private bool $is_valid = false;

    // Renommage du getter
    public function getIsValid(): bool
    {
        return $this->is_valid;
    }

    // Renommage du setter
    public function setIsValid(bool $is_valid): self
    {
        $this->is_valid = $is_valid;
        return $this;
    }

    // Autres méthodes
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function __construct(?string $email = null)
    {
        $this->email = $email;
    }
}