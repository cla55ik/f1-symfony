<?php

namespace App\EntityListener;

use App\Entity\Race;
use App\Entity\Racestat;
use App\Entity\RaceType;
use App\Service\CalculatePointsService;
use Doctrine\ORM\Event\LifecycleEventArgs;

class RacestatEntityListener
{

    private CalculatePointsService $calculatePointsService;

    public function __construct(CalculatePointsService $calculatePointsService)
    {
        $this->calculatePointsService = $calculatePointsService;
    }

    public function prePersist(Racestat $racestat, LifecycleEventArgs $args)
    {
        $racePoint = $this->calculatePointsService->calculatePoints($racestat);
        $racestat->setCalculatedPoint($racePoint);
    }

    public function preUpdate(Racestat $racestat, LifecycleEventArgs $args)
    {
        $racePoint = $this->calculatePointsService->calculatePoints($racestat);
        $racestat->setCalculatedPoint($racePoint);
    }

}