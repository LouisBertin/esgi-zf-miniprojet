<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Element\DateTime;

/**
 * Class Meeting
 *
 *
 * @package Application\Entity
 * @ORM\Entity
 * @ORM\Table(name="meeting")
 */
class Meeting
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=50)
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $description = '';

    /**
     * @ORM\Column(type="datetime", name="starting_date")
     */
    private $startingDate;

    /**
     * @ORM\Column(type="datetime", name="ending_date")
     */
    private $endingDate;

    /**
     * Meeting constructor.
     * @param $id
     * @param $title
     * @param string $description
     * @param $startingDate
     * @param $endingDate
     */
    public function __construct($id, $title, $description, $startingDate, $endingDate)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->startingDate = $startingDate;
        $this->endingDate = $endingDate;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return void
     */
    public function setId($id) : void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title) : void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description) : void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStartingDate() : DateTime
    {
        return $this->startingDate;
    }

    /**
     * @param $startingDate
     */
    public function setStartingDate($startingDate) : void
    {
        $this->startingDate = $startingDate;
    }

    /**
     * @return DateTime
     */
    public function getEndingDate() : DateTime
    {
        return $this->endingDate;
    }

    /**
     * @param $endingDate
     */
    public function setEndingDate($endingDate) : void
    {
        $this->endingDate = $endingDate;
    }
}