<?php


namespace App\Calendar;

use DateTime;

class Event
{
    private $begin;

    private $end;

    private $dateCreation;

    private $uid;

    private $description;

    private $title;

    private $location;

    /**
     * @return DateTime
     */
    public function getBegin(): DateTime
    {
        return $this->begin;
    }

    /**
     * @param DateTime $begin
     * @return Event
     */
    public function setBegin(DateTime $begin): self
    {
        $this->begin = $begin;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateCreation(): DateTime
    {
        return $this->dateCreation;
    }

    /**
     * @param DateTime $dateCreation
     * @return Event
     */
    public function setDateCreation(DateTime $dateCreation): self
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Event
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getEnd(): DateTime
    {
        return $this->end;
    }

    /**
     * @param DateTime $end
     * @return Event
     */
    public function setEnd(DateTime $end): self
    {
        $this->end = $end;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return Event
     */
    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Event
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     * @return Event
     */
    public function setUid(string $uid): self
    {
        $this->uid = $uid;
        return $this;
    }
}
