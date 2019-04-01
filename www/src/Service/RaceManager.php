<?php

namespace App\Service;


use App\Collection\ParticipantCollection;
use App\Entity\Race;
use App\Exception\RaceCreationException;
use App\Exception\RaceNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class RaceManager
{
    /** @var EntityManagerInterface $em */
    private $em;

    /**
     * ParticipantManager constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Get race by id
     *
     * @param int $raceId
     * @return Race
     * @throws RaceNotFoundException
     */
    public function getById(int $raceId): Race
    {
        $race = $this->em->getRepository(Race::class)->find($raceId);

        if (!$race || !$race instanceof Race) {
            throw new RaceNotFoundException('Race not found', 404);
        }

        return $race;
    }

    /**
     * Create a new Race
     *
     * @param ParticipantCollection $participantCollection
     *
     * @return Race
     *
     * @throws RaceCreationException
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function create(ParticipantCollection $participantCollection): Race
    {
        $this->em->getConnection()->beginTransaction();

        try {
            $race = new Race();
            $race->setStartDate(new \DateTime());
            $race->setParticipants($participantCollection);
            $race->setDistance(Race::DISTANCE);
            $race->setActive(true);

            $this->em->persist($race);
            $this->em->flush();

            $this->em->getConnection()->commit();
        } catch (\Exception $e) {
            $this->em->getConnection()->rollBack();
            throw new RaceCreationException($e->getMessage(), $e->getCode(), $e);
        }

        return $race;
    }

    /**
     * Finish race
     *
     * @param Race $race
     */
    public function finish(Race &$race)
    {
        $race->setActive(false);

    }

    /**
     * Update race state
     *
     * @param Race $race
     */
    public function updateState(Race $race)
    {
        $this->em->persist($race);
        $this->em->flush();
    }
}