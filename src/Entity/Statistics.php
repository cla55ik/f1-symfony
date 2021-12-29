<?php

namespace App\Entity;

use App\Repository\StatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatisticsRepository::class)]
class Statistics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $race_start;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $race_finish;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $poul_position;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $start_position;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $finish_position;

    #[ORM\ManyToOne(targetEntity: Pilot::class, inversedBy: 'statistics')]
    private $pilot;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $points;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaceStart(): ?int
    {
        return $this->race_start;
    }

    public function setRaceStart(?int $race_start): self
    {
        $this->race_start = $race_start;

        return $this;
    }

    public function getRaceFinish(): ?int
    {
        return $this->race_finish;
    }

    public function setRaceFinish(?int $race_finish): self
    {
        $this->race_finish = $race_finish;

        return $this;
    }

    public function getPoulPosition(): ?int
    {
        return $this->poul_position;
    }

    public function setPoulPosition(?int $poul_position): self
    {
        $this->poul_position = $poul_position;

        return $this;
    }

    public function getStartPosition(): ?int
    {
        return $this->start_position;
    }

    public function setStartPosition(?int $start_position): self
    {
        $this->start_position = $start_position;

        return $this;
    }

    public function getFinishPosition(): ?int
    {
        return $this->finish_position;
    }

    public function setFinishPosition(?int $finish_position): self
    {
        $this->finish_position = $finish_position;

        return $this;
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

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): self
    {
        $this->points = $points;

        return $this;
    }
}
