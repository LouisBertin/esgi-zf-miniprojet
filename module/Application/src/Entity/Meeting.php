<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStartingDate()
    {
        return $this->startingDate;
    }

    /**
     * @param mixed $startingDate
     */
    public function setStartingDate($startingDate)
    {
        $this->startingDate = $startingDate;
    }

    /**
     * @return mixed
     */
    public function getEndingDate()
    {
        return $this->endingDate;
    }

    /**
     * @param mixed $endingDate
     */
    public function setEndingDate($endingDate)
    {
        $this->endingDate = $endingDate;
    }
}