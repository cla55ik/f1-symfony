<?php

namespace App\Entity;

use App\Repository\ComandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComandRepository::class)]
class Comand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'comand', targetEntity: Pilot::class)]
    private $pilot;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'comand')]
    private $country;

    public function __construct()
    {
        $this->pilot = new ArrayCollection();
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
            $pilot->setComand($this);
        }

        return $this;
    }

    public function removePilot(Pilot $pilot): self
    {
        if ($this->pilot->removeElement($pilot)) {
            // set the owning side to null (unless already changed)
            if ($pilot->getComand() === $this) {
                $pilot->setComand(null);
            }
        }

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
