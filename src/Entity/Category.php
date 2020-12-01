<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="datetime", nullable=true)

     */
    private $publicationdate;

    /**
     * @ORM\Column(type="datetime" , nullable=true)
     */
    private $creationdate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * )
     */
    private $published;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="category")
     */
    private $articles;


    /**
     * le __construct contient les elements qui seront transmis par defaut a la nouvelle methode lorsque nous ferons appelle
     * a la methodes New Category
     *
     */
    public function __construct()
    {
                // ArrayCollection methodes appartenant a symfony
        $this->articles = new ArrayCollection();
    }

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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }


    public function getPublicationdate(): ?\DateTimeInterface
    {
        return $this->publicationdate;
    }

    public function setPublicationdate(\DateTimeInterface $publicationdate): self
    {
        $this->publicationdate = $publicationdate;

        return $this;
    }

    public function getCreationdate(): ?\DateTimeInterface
    {
        return $this->creationdate;
    }

    public function setCreationdate(\DateTimeInterface $creationdate): self
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    public function getPublished(): ?Bool
    {
        return $this->published;
    }

    public function setPublished(?Bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    /**
     * @return Collection|Article[]
     *
     * permet d'afficher tout les articles
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

     /**
     * une catégories peux etre relie a plusieurs articles donc cela crée un tableau qui va contenir tout les articles
      * de cette catégory
     */

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setCategory($this);
        }

        return $this;
    }

    /**
     * Va permettre de supprimer une liaison category -> articles sans suprimer la catégorie
     */

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getCategory() === $this) {
                $article->setCategory(null);
            }
        }

        return $this;
    }
}
