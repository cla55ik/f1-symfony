<?php

namespace App\Entity;

use App\Repository\PilotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PilotRepository::class)]
class Pilot
{
    const IMG_UPLOAD_DIR = 'uploads/pilot';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $surname;

    #[ORM\ManyToOne(targetEntity: Comand::class, inversedBy: 'pilot')]
    #[ORM\JoinColumn(nullable: false)]
    private $comand;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'pilot')]
    private $country;

    #[ORM\OneToMany(mappedBy: 'pilot', targetEntity: Statistics::class)]
    private $statistics;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $img;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $number;

    #[ORM\OneToMany(mappedBy: 'pilot', targetEntity: Racestat::class)]
    private $racestats;

    public function __construct()
    {
        $this->statistics = new ArrayCollection();
        $this->racestats = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getName() . ' ' .$this->getSurname();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getComand(): ?Comand
    {
        return $this->comand;
    }

    public function setComand(?Comand $comand): self
    {
        $this->comand = $comand;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Statistics[]
     */
    public function getStatistics(): Collection
    {
        return $this->statistics;
    }

    public function addStatistic(Statistics $statistic): self
    {
        if (!$this->statistics->contains($statistic)) {
            $this->statistics[] = $statistic;
            $statistic->setPilot($this);
        }

        return $this;
    }

    public function removeStatistic(Statistics $statistic): self
    {
        if ($this->statistics->removeElement($statistic)) {
            // set the owning side to null (unless already changed)
            if ($statistic->getPilot() === $this) {
                $statistic->setPilot(null);
            }
        }

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Collection|Racestat[]
     */
    public function getRacestats(): Collection
    {
        return $this->racestats;
    }

    public function addRacestat(Racestat $racestat): self
    {
        if (!$this->racestats->contains($racestat)) {
            $this->racestats[] = $racestat;
            $racestat->setPilot($this);
        }

        return $this;
    }

    public function removeRacestat(Racestat $racestat): self
    {
        if ($this->racestats->removeElement($racestat)) {
            // set the owning side to null (unless already changed)
            if ($racestat->getPilot() === $this) {
                $racestat->setPilot(null);
            }
        }

        return $this;
    }
}
