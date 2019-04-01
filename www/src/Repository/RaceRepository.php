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
     * @return ArrayCollection
     */
    public function getActiveList(): ArrayCollection
    {
        $this->findBy(
            ['active' => true],
            ['start_date' => 'DESC']
        );
    }

    /**
     * Get Last Finished Races
     *
     * @param $maxResults
     *
     * @return ArrayCollection
     */
    public function getLastFinished($maxResults): ArrayCollection
    {
        $this->findBy(
            ['active' => false],
            ['start_date' => 'DESC'],
            $maxResults
        );
    }

    /**
     * Get the Best Race by time
     *
     * @return Race
     */
    public function getBestRace(): Race
    {
        $this->findOneBy(
            ['active' => false],
            ['best_time' => 'ASK']
        );
    }
}