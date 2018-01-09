<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Organizer
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Application\Repository\OrganizerRepository")
 * @ORM\Table(name="organizer")
 */
class Organizer
{
    /**
     * @ORM\Column(type="string", type="integer", nullable=false, length=50)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=200, nullable=false)
     */
    private $email;

    /**
     * Organizer constructor.
     * @param $lastname
     * @param $firstname
     * @param $email
     */
    public function __construct($lastname, $firstname, $email)
    {
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}