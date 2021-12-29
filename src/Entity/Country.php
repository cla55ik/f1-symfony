<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Pilot::class)]
    private $pilot;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Comand::class)]
    private $comand;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Races::class)]
    private $races;

    public function __construct()
    {
        $this->pilot = new ArrayCollection();
        $this->comand = new ArrayCollection();
        $this->races = new ArrayCollection();
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

    /**
     * @return Collection|Pilot[]
     */
    public function getPilot(): Collection
    {
        return $this->pilot;
    }

    public function addPilot(Pilot $pilot): self
    {
        if (!$this->pilot->contains($pilot)) {
            $this->pilot[] = $pilot;
            $pilot->setCountry($this);
        }

        return $this;
    }

    public function removePilot(Pilot $pilot): self
    {
        if ($this->pilot->removeElement($pilot)) {
            // set the owning side to null (unless already changed)
            if ($pilot->getCountry() === $this) {
                $pilot->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comand[]
     */
    public function getComand(): Collection
    {
        return $this->comand;
    }

    public function addComand(Comand $comand): self
    {
        if (!$this->comand->contains($comand)) {
            $this->comand[] = $comand;
            $comand->setCountry($this);
        }

        return $this;
    }

    public function removeComand(Comand $comand): self
    {
        if ($this->comand->removeElement($comand)) {
            // set the owning side to null (unless already changed)
            if ($comand->getCountry() === $this) {
                $comand->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Races[]
     */
    public function getRaces(): Collection
    {
        return $this->races;
    }

    public function addRace(Races $race): self
    {
        if (!$this->races->contains($race)) {
            $this->races[] = $race;
            $race->setCountry($this);
        }

        return $this;
    }

    public function removeRace(Races $race): self
    {
        if ($this->races->removeElement($race)) {
            // set the owning side to null (unless already changed)
            if ($race->getCountry() === $this) {
                $race->setCountry(null);
            }
        }

        return $this;
    }
}
