<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'Categories')]
    private Collection $comments;

    #[ORM\Column(length: 10)]
    private ?string $color = null;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\OneToMany(targetEntity: Media::class, mappedBy: 'categories', orphanRemoval: true)]
    private Collection $headerImage;



    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->headerImage = new ArrayCollection();
    }

    /**
     * @var Collection<int, Comment>
     */



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }




    
    public function __toString(): string
    {
        return $this->name; // Retourne le nom de la catégorie lorsque PHP essaie de la convertir en chaîne
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setCategories($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCategories() === $this) {
                $comment->setCategories(null);
            }
        }

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getHeaderImage(): Collection
    {
        return $this->headerImage;
    }

    public function addHeaderImage(Media $headerImage): static
    {
        if (!$this->headerImage->contains($headerImage)) {
            $this->headerImage->add($headerImage);
            $headerImage->setCategories($this);
        }

        return $this;
    }

    public function removeHeaderImage(Media $headerImage): static
    {
        if ($this->headerImage->removeElement($headerImage)) {
            // set the owning side to null (unless already changed)
            if ($headerImage->getCategories() === $this) {
                $headerImage->setCategories(null);
            }
        }

        return $this;
    }


}
