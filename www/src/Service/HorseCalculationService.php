<?php

namespace App\Service;


use App\Entity\Horse;

class HorseCalculationService
{
    /**
     * Calculate horse distance
     *
     * @param Horse $horse
     * @param int $distance
     * @return float
     */
    public function calculateDistance(Horse $horse, int $distance): float
    {
        $distance += $horse->getMaxSpeedDistance() < $distance ? $horse->getMaxSpeed() : $horse->getSlowSpeed();

        return $distance;
    }
}