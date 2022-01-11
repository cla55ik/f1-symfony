<?php

namespace App\Entity;

use App\Repository\RaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RaceRepository::class)]
class Race
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\ManyToOne(targetEntity: Country::class)]
    private $Country;

    #[ORM\Column(type: 'date', nullable: true)]
    private $Date;

    #[ORM\OneToMany(mappedBy: 'race', targetEntity: Racestat::class)]
    private $racestats;

    #[ORM\ManyToOne(targetEntity: RaceType::class)]
    private $type;


    public function __construct()
    {
        $this->racestats = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->Country;
    }

    public function setCountry(?Country $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(?\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

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
            $racestat->setRace($this);
        }

        return $this;
    }

    public function removeRacestat(Racestat $racestat): self
    {
        if ($this->racestats->removeElement($racestat)) {
            // set the owning side to null (unless already changed)
            if ($racestat->getRace() === $this) {
                $racestat->setRace(null);
            }
        }

        return $this;
    }

    public function getType(): ?RaceType
    {
        return $this->type;
    }

    public function setType(?RaceType $type): self
    {
        $this->type = $type;

        return $this;
    }


}
