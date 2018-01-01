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
     * @ORM\Column(type="string", length=36)
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
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
}