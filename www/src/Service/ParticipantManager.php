<?php

namespace App\Service;

use App\Collection\ParticipantCollection;
use App\Entity\Horse;
use App\Entity\Participant;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ParticipantManager
 *
 * @package App\Service
 */
class ParticipantManager
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
     * Prepare participants and book horses
     *
     * @param $number
     *
     * @return ParticipantCollection
     */
    public function prepareParticipants($number): ParticipantCollection
    {
        $horses = $this->em->getRepository(Horse::class)
            ->getAvailableList($number);

        $participantCollection = new ParticipantCollection();

        /** @var Horse $horse */
        foreach ($horses as $horse) {
            $participant = new Participant();
            $participant->setHorse($horse);

            $participantCollection->add($participant);

            $horse->setActive(false);
            $this->em->persist($horse);
        }

        $this->em->flush();

        return $participantCollection;
    }

    /**
     * Release participants for next races
     *
     * @param ArrayCollection $participants
     */
    public function releaseParticipants(ArrayCollection $participants): void
    {
        /** @var Participant $participant */
        foreach ($participants as $participant)
        {
            $horse = $participant->getHorse();
            $horse->setActive(true);
            $this->em->persist($horse);
        }

        $this->em->flush();
    }
}