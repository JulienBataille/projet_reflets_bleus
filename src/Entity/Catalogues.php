<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CataloguesRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CataloguesRepository::class)]
#[Vich\Uploadable]
class Catalogues
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PDF = null;

    #[ORM\Column(type: 'boolean')]
    private bool $is_visible = true;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thumbnailImage = null;
    
    #[Vich\UploadableField(mapping: 'catalogue_pdfs', fileNameProperty: 'PDF')]
    private ?File $PDFFile = null;

    #[Vich\UploadableField(mapping: 'catalogue_thumbnails', fileNameProperty: 'thumbnailImage')]
    private ?File $thumbnailImageFile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPDF(): ?string
    {
        return $this->PDF;
    }

    public function setPDF(?string $PDF): static
    {
        $this->PDF = $PDF;

        return $this;
    }

    public function getIsVisible(): ?bool
    {
        return $this->is_visible;
    }

    public function setIsVisible(bool $is_visible): static
    {
        $this->is_visible = $is_visible;

        return $this;
    }

    public function getPDFFile(): ?File
    {
        return $this->PDFFile;
    }

    public function setPDFFile(?File $PDFFile = null): void
    {
        $this->PDFFile = $PDFFile;

        if ($PDFFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getThumbnailImage(): ?string
    {
        return $this->thumbnailImage;
    }

    public function setThumbnailImage(?string $thumbnailImage): static
    {
        $this->thumbnailImage = $thumbnailImage;

        return $this;
    }

    public function getThumbnailImageFile(): ?File
    {
        return $this->thumbnailImageFile;
    }

    public function setThumbnailImageFile(?File $thumbnailImageFile = null): void
    {
        $this->thumbnailImageFile = $thumbnailImageFile;

        if ($thumbnailImageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function removeFile(): void
    {
        if ($this->PDF) {
            $filesystem = new Filesystem();
            $filePath = sprintf('%s/public/uploads/catalogues/pdf/%s', $_SERVER['DOCUMENT_ROOT'], $this->PDF);
            
            if ($filesystem->exists($filePath)) {
                $filesystem->remove($filePath);
            }
        }

        if ($this->thumbnailImage) {
            $filesystem = new Filesystem();
            $filePath = sprintf('%s/public/uploads/catalogues/thumbnails/%s', $_SERVER['DOCUMENT_ROOT'], $this->thumbnailImage);
            
            if ($filesystem->exists($filePath)) {
                $filesystem->remove($filePath);
            }
        }
    }
}
