<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity()
 */
class Run
{
    /**
     * @ORM\GeneratedValue()
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Route")
     */
    private $route;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $seconds;

    public function getRoute(): string
    {
        return $this->route;
    }

    public function setRoute(Route $route)
    {
        $this->route = $route;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }

    public function getSeconds(): string
    {
        return $this->seconds;
    }

    public function setSeconds(int $seconds)
    {
        $this->seconds = $seconds;
    }
}
