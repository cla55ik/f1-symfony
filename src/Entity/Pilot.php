<?php

namespace App\Entity;

use App\Repository\PilotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PilotRepository::class)]
class Pilot
{
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
}
