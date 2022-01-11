<?php

namespace App\Entity;

use App\Repository\RaceTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RaceTypeRepository::class)]
class RaceType
{

    const RACE_TYPE_FULL = 'full';
    const RACE_TYPE_SPRINT = 'sprint';
    const RACE_TYPE_SUSPENDED = 'suspended';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    public function __toString()
    {
        return $this->type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
