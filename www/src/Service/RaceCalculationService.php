<?php

namespace App\Service;

use App\Entity\Participant;
use App\Entity\Race;

/**
 * Class RaceCalculationService
 *
 * @package App\Service
 */
class RaceCalculationService
{
    /** @var ParticipantManager $participantManager */
    private $participantManager;

    /**
     * RaceCalculationService constructor.
     *
     * @param ParticipantManager $participantManager
     */
    public function __construct(ParticipantManager $participantManager)
    {
        $this->participantManager = $participantManager;
    }

    /**
     * Proceed race calculation
     *
     * @param Race $race
     */
    public function proceed(Race &$race): void
    {
        $participantCalculator = new ParticipantCalculationService(Race::DISTANCE);

        $participants = $race->getActiveParticipants();

        /** @var Participant $participant */
        foreach ($participants as $participant) {
            $seconds = Race::PROCEED_SECONDS;

            do {
                $participant = $participantCalculator->proceed($participant);
            } while (--$seconds > 0 && $participant->isActive());
        }

        $participants = $participantCalculator->calculatePositions($participants);
        $leader = $participantCalculator->getLeader($participants);

        $race->setParticipants($participants);
        $race->setLeader($leader->getHorse());
        $race->setBestTime($leader->getTime());
        $race->setCurrentTime($race->getCurrentTime() + Race::PROCEED_SECONDS);
        $this->checkFinish($race);
    }

    /**
     * Race finish
     *
     * @param Race $race
     *
     * @return bool
     */
    public function checkFinish(Race &$race): bool
    {
        if ($race->getActiveParticipants()->count() !== 0) {
            return false;
        }

        $race->setActive(false);

        $this->participantManager->releaseParticipants($race->getParticipants());

        return true;
    }
}