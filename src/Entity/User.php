<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ModulePref", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Pref;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FollowedStation", mappedBy="user", orphanRemoval=true)
     */
    private $FollowedStations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Weather", mappedBy="user", orphanRemoval=true)
     */
    private $Weathers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Calendar", mappedBy="user", orphanRemoval=true)
     */
    private $Calendars;

    public function __construct()
    {
        $this->FollowedStations = new ArrayCollection();
        $this->Weathers = new ArrayCollection();
        $this->Calendars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPref(): ?ModulePref
    {
        return $this->Pref;
    }

    public function setPref(ModulePref $Pref): self
    {
        $this->Pref = $Pref;

        return $this;
    }

    /**
     * @return Collection|FollowedStation[]
     */
    public function getFollowedStations(): Collection
    {
        return $this->FollowedStations;
    }

    public function addFollowedStation(FollowedStation $followedStation): self
    {
        if (!$this->FollowedStations->contains($followedStation)) {
            $this->FollowedStations[] = $followedStation;
            $followedStation->setUser($this);
        }

        return $this;
    }

    public function removeFollowedStation(FollowedStation $followedStation): self
    {
        if ($this->FollowedStations->contains($followedStation)) {
            $this->FollowedStations->removeElement($followedStation);
            // set the owning side to null (unless already changed)
            if ($followedStation->getUser() === $this) {
                $followedStation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Weather[]
     */
    public function getWeathers(): Collection
    {
        return $this->Weathers;
    }

    public function addWeather(Weather $weather): self
    {
        if (!$this->Weathers->contains($weather)) {
            $this->Weathers[] = $weather;
            $weather->setUser($this);
        }

        return $this;
    }

    public function removeWeather(Weather $weather): self
    {
        if ($this->Weathers->contains($weather)) {
            $this->Weathers->removeElement($weather);
            // set the owning side to null (unless already changed)
            if ($weather->getUser() === $this) {
                $weather->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Calendar[]
     */
    public function getCalendars(): Collection
    {
        return $this->Calendars;
    }

    public function addCalendar(Calendar $calendar): self
    {
        if (!$this->Calendars->contains($calendar)) {
            $this->Calendars[] = $calendar;
            $calendar->setUser($this);
        }

        return $this;
    }

    public function removeCalendar(Calendar $calendar): self
    {
        if ($this->Calendars->contains($calendar)) {
            $this->Calendars->removeElement($calendar);
            // set the owning side to null (unless already changed)
            if ($calendar->getUser() === $this) {
                $calendar->setUser(null);
            }
        }

        return $this;
    }
}
