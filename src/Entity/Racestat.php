<?php

namespace App\Entity;

use App\Repository\RacestatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RacestatRepository::class)]
class Racestat
{
    const POINTS_FULL_RACE = [
        1 => 25,
        2 => 18,
        3 => 15,
        4 => 12,
        5 => 10,
        6 => 8,
        7 => 6,
        8 => 4,
        9 => 2,
        10 => 1
    ];

    const POINTS_SUSPENDED_RACE = [
        1 => 12.5,
        2 => 9,
        3 => 7.5,
        4 => 6,
        5 => 5,
        6 => 4,
        7 => 3,
        8 => 2,
        9 => 1,
        10 => 0.5
    ];

    const POINTS_SPRINT = [
      1 => 3,
      2 => 2,
      3 => 1
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Pilot::class, inversedBy: 'racestats')]
    private $pilot;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $place;

    #[ORM\ManyToOne(targetEntity: Race::class, inversedBy: 'racestats')]
    private $race;

    #[ORM\Column(type: 'float', nullable: true)]
    private $point;

    public function setCalculatedPoint(float $calculatedPoint)
    {
        $this->point = $calculatedPoint;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPilot(): ?Pilot
    {
        return $this->pilot;
    }

    public function setPilot(?Pilot $pilot): self
    {
        $this->pilot = $pilot;

        return $this;
    }

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(?int $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getPoint(): ?float
    {
        return $this->point;
    }

    public function setPoint(?float $point): self
    {
        $this->point = $point;

        return $this;
    }
}
