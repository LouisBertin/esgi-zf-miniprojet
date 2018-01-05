<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Class Meeting
 *
 *
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Application\Repository\MeetupRepository")
 * @ORM\Table(name="meeting")
 */
class Meeting
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
     * @ORM\Column(type="boolean", nullable=false, name="is_active", options={"default":1})
     */
    private $is_active = 1;


    public function __construct(string $title, string $description, DateTime $startingDate, DateTime $endingDate)
    {
        $this->title = $title;
        $this->description = $description;
        $this->startingDate = $startingDate;
        $this->endingDate = $endingDate;
    }

    /**
     * @return int
     */
    public function getId() : int
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

    /**
     * @return bool
     */
    public function getisActive() : bool
    {
        return $this->is_active;
    }

    /**
     * @param mixed $is_active
     */
    public function setIsActive($is_active): void
    {
        $this->is_active = $is_active;
    }
}