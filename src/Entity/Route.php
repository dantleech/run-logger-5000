<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Route
{
    /**
     * @ORM\GeneratedValue()
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title = '';

    /**
     * @ORM\Column(type="integer")
     */
    private $meters = 0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Run", mappedBy="route")
     */
    private $runs;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getMeters(): int
    {
        return $this->meters;
    }

    public function setMeters(int $meters)
    {
        $this->meters = $meters;
    }

    public function getRuns()
    {
        return $this->runs;
    }
}
