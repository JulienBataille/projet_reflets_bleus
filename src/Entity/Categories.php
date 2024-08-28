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

    #[ORM\Column(length: 7, nullable: true)]
    private ?string $iconLight = null;

    #[ORM\Column(length: 7, nullable: true)]
    private ?string $iconDark = null;

    /**
     * @var Collection<int, Slider>
     */
    #[ORM\OneToMany(targetEntity: Slider::class, mappedBy: 'Category')]
    private Collection $sliders;

    public function __construct()
    {
        $this->sliders = new ArrayCollection();

        $this->iconLight = null;
        $this->iconDark = null;
    }

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

    public function getIconLight(): ?string
    {
        return $this->iconLight;
    }

    public function setIconLight(?string $iconLight): static
    {
        $this->iconLight = $iconLight;

        return $this;
    }

    public function getIconDark(): ?string
    {
        return $this->iconDark;
    }

    public function setIconDark(?string $iconDark): static
    {
        $this->iconDark = $iconDark;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name; 
    }

    /**
     * @return Collection<int, Slider>
     */
    public function getSliders(): Collection
    {
        return $this->sliders;
    }

    public function addSlider(Slider $slider): static
    {
        if (!$this->sliders->contains($slider)) {
            $this->sliders->add($slider);
            $slider->setCategory($this);
        }

        return $this;
    }

    public function removeSlider(Slider $slider): static
    {
        if ($this->sliders->removeElement($slider)) {
            if ($slider->getCategory() === $this) {
                $slider->setCategory(null);
            }
        }

        return $this;
    }


}
