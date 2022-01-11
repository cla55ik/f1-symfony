<?php

namespace App\Service;

use App\Entity\Racestat;
use App\Entity\RaceType;

class CalculatePointsService
{
    public function calculatePoints(Racestat $racestat)
    {
        $raceType = $racestat->getRace()->getType();
        $racePlace = $racestat->getPlace();

        if($raceType == RaceType::RACE_TYPE_SPRINT && $racePlace > 3){
            return 0;
        }

        if($racePlace > 10){
            return 0;
        }

        if($raceType == RaceType::RACE_TYPE_FULL){
            return Racestat::POINTS_FULL_RACE[$racePlace];
        }

        if($raceType == RaceType::RACE_TYPE_SUSPENDED){
            return Racestat::POINTS_SUSPENDED_RACE[$racePlace];
        }

        if($raceType == RaceType::RACE_TYPE_SPRINT){
            return Racestat::POINTS_SPRINT[$racePlace];
        }

        return 0;

    }
}