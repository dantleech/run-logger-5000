<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
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
    private $seconds = 0;

    public function __construct()
    {
        $this->date = new DateTime('c');
    }

    public function getRoute(): Route
    {
        return $this->route;
    }

    public function setRoute(Route $route)
    {
        $this->route = $route;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }

    public function getSeconds(): int
    {
        return $this->seconds;
    }

    public function setSeconds(int $seconds)
    {
        $this->seconds = $seconds;
    }
}
