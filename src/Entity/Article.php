<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

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
     *
     * @Assert\Length(
     *     min=5,
     *     max=50,
     *     minMessage=" Ton titre n'est pas assez long",
     *     maxMessage="Ton titre est trop long"
     * )
     * @Assert\NotBlank(
     *     message="Tu dois remplir ce champ"
     * )
     *
     * @Assert\NotNull(
     *     message="ton titre n'est pas valide"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */

    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(
     *     message="Tu dois remplir ce champ"
     * )
     *
     */

    private $picture;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Assert\NotBlank(
     *     message="Tu dois remplir ce champ"
     * )
     *
     * @Assert\Type("Datetime")
     *
     * @Assert\Expression(
     *     "this.getpublicationdate() > this.getcreationdate()",
     *     message="La date de publication ne doit pas être antérieure à la date de creation"
     * )
     */

    private $publicationdate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     *
     * @Assert\NotBlank(
     *     message="Tu dois remplir ce champ"
     * )
     *
     * @Assert\Type("Datetime")
     *
     */

    private $creationdate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     *
     */

    private $published;

    /**
     * @ORM\ManyToOne(targetEntity=category::class, inversedBy="articles")
     *
     * inversedBy nous spécifie que la Class catégory renvoie des informations d'article
     */
    private $category;


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

    public function getPublicationdate()
    {
        return $this->publicationdate;
    }

    public function setPublicationdate($publicationdate): self
    {
        $this->publicationdate = $publicationdate;

        return $this;
    }

    public function getCreationdate()
    {
        return $this->creationdate;
    }

    public function setCreationdate($creationdate): self
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(?bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
