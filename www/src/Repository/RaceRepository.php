<?php

namespace App\Repository;

use App\Entity\Race;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

class RaceRepository extends EntityRepository
{
    /**
     * Get Active Races
     *
     * @return array
     */
    public function getActiveList(): ?array
    {
        return $this->findBy(
            ['active' => true],
            ['startDate' => 'DESC']
        );
    }

    /**
     * Get Last Finished Races
     *
     * @param $maxResults
     *
     * @return array
     */
    public function getLastFinished($maxResults): ?array
    {
        return $this->findBy(
            ['active' => false],
            ['startDate' => 'DESC'],
            $maxResults
        );
    }

    /**
     * Get the Best Race by time
     *
     * @return Race
     */
    public function getBestRace(): ?Race
    {
        return $this->findOneBy(
            ['active' => false],
            ['bestTime' => 'ASC']
        );
    }
}