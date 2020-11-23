<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="date", length=255, nullable=true)
     */
    private $publicationdate;

    /**
     * @ORM\Column(type="date", length=255, nullable=true)
     */
    private $creationdate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $published;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPublicationdate(): ?date
    {
        return $this->publicationdate;
    }

    public function setPublicationdate(?date $publicationdate): self
    {
        $this->publicationdate = $publicationdate;

        return $this;
    }

    public function getCreationdate(): ?date
    {
        return $this->creationdate;
    }

    public function setCreationdate(?date $creationdate): self
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    public function getPublished(): ?int
    {
        return $this->published;
    }

    public function setPublished(?int $published): self
    {
        $this->published = $published;

        return $this;
    }
}
