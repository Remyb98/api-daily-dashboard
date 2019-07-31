<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModulePrefRepository")
 */
class ModulePref
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $calendar;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $weather;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $transport;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $news;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalendar(): ?bool
    {
        return $this->calendar;
    }

    public function setCalendar(?bool $calendar): self
    {
        $this->calendar = $calendar;

        return $this;
    }

    public function getWeather(): ?bool
    {
        return $this->weather;
    }

    public function setWeather(?bool $weather): self
    {
        $this->weather = $weather;

        return $this;
    }

    public function getTransport(): ?bool
    {
        return $this->transport;
    }

    public function setTransport(?bool $transport): self
    {
        $this->transport = $transport;

        return $this;
    }

    public function getNews(): ?bool
    {
        return $this->news;
    }

    public function setNews(?bool $news): self
    {
        $this->news = $news;

        return $this;
    }
}
