<?php


namespace App\Entity;

use App\Repository\DonneesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity (repositoryClass=DonneesRepository::class)
 */
class Donnees
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
    private $author;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $content;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }



}