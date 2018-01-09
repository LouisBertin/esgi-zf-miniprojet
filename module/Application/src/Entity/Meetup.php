<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Class Meetup
 *
 *
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Application\Repository\MeetupRepository")
 * @ORM\Table(name="meetup")
 */
class Meetup
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
     * @ORM\Column(type="string", name="img")
     */
    private $img;

    /**
     * @ORM\Column(type="boolean", nullable=false, name="is_active", options={"default":1})
     */
    private $is_active = 1;

    /**
     * Many Meetup have Many Organizer.
     * @ORM\ManyToMany(targetEntity="Organizer")
     * @ORM\JoinTable(name="meetup_organizer",
     *      joinColumns={@ORM\JoinColumn(name="meetup_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="organizer_id", referencedColumnName="id")}
     *      )
     */
    private $organizer;

    /**
     * Meetup constructor.
     * @param string $title
     * @param string $description
     * @param DateTime $startingDate
     * @param DateTime $endingDate
     * @param string $img
     * @param ArrayCollection $organizer
     */
    public function __construct(string $title, string $description, DateTime $startingDate, DateTime $endingDate, string $img, ArrayCollection $organizer)
    {
        $this->title = $title;
        $this->description = $description;
        $this->startingDate = $startingDate;
        $this->endingDate = $endingDate;
        $this->img = $img;
        $this->$organizer = new ArrayCollection();
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

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img): void
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * @param mixed $organizer
     */
    public function setOrganizer($organizer)
    {
        $this->organizer = $organizer;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        $array = [];

        foreach ($this as $key => $value) {
            if ($value instanceof DateTime) {
                $array[$key] = $value->format('m/d/Y');
                continue;
            }
            $array[$key] = $value;
        }

        return $array;
    }
}
