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
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Meetup", mappedBy="organizer", cascade={"remove"})
     */
    private $meetup;

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
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLastname() : string
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getFirstname() : string
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMeetup()
    {
        return $this->meetup;
    }

    /**
     * @param mixed $meetup
     */
    public function setMeetup($meetup)
    {
        $this->meetup = $meetup;
    }
}
