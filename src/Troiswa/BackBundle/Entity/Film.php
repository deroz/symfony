<?php

namespace Troiswa\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Film
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Troiswa\BackBundle\Entity\FilmRepository")
 */
class Film
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=50)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeRealisation", type="date")
     */
    private $dateDeRealisation;

    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Troiswa\BackBundle\Entity\Genres")
     */
    private $liaisonGenre;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Film
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Film
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateDeRealisation
     *
     * @param \DateTime $dateDeRealisation
     * @return Film
     */
    public function setDateDeRealisation($dateDeRealisation)
    {
        $this->dateDeRealisation = $dateDeRealisation;

        return $this;
    }

    /**
     * Get dateDeRealisation
     *
     * @return \DateTime 
     */
    public function getDateDeRealisation()
    {
        return $this->dateDeRealisation;
    }

    /**
     * Set note
     *
     * @param integer $note
     * @return Film
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Film
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
    public function displayImage()
    {
        return "images/films/".$this->image;
    }


    /**
     * Set liaisonGenre
     *
     * @param \Troiswa\BackBundle\Entity\Genres $liaisonGenre
     * @return Film
     */
    public function setLiaisonGenre(\Troiswa\BackBundle\Entity\Genres $liaisonGenre = null)
    {
        $this->liaisonGenre = $liaisonGenre;

        return $this;
    }

    /**
     * Get liaisonGenre
     *
     * @return \Troiswa\BackBundle\Entity\Genres 
     */
    public function getLiaisonGenre()
    {
        return $this->liaisonGenre;
    }
}
