<?php

namespace App\Entity;

use App\Collection\ParticipantCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use \DateTime;

/**
 * Class Race
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="race")
 * @ORM\Entity(repositoryClass="App\Repository\RaceRepository")
 */
class Race extends AbstractEntity
{
    /** @var int */
    const NUMBER_OF_PARTICIPANTS = 8;

    /** @var int */
    const DISTANCE = 1500;

    /** @var int */
    const PROCEED_SECONDS = 10;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @var Participant[]|ArrayCollection
     *
     * @ORM\OneToMany(
     *      targetEntity="Participant",
     *      mappedBy="race",
     *      orphanRemoval=true,
     *      cascade={"persist"}
     * )
     */
    private $participants;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $distance = 0;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $bestTime = 0;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $currentTime = 0;

    /**
     * @var Horse
     *
     * @ORM\ManyToOne(targetEntity="Race", cascade={"persist"})
     */
    private $leader;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * Race constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->startDate = new DateTime();
        $this->endDate = new DateTime();
        $this->participants = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     */
    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     */
    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return Participant[]|ArrayCollection
     */
    public function getParticipants(): ArrayCollection
    {
        return $this->participants;
    }

    /**
     * @param ParticipantCollection|ArrayCollection $participants
     */
    public function setParticipants($participants): void
    {
        $this->participants = $participants;

        /** @var Participant $participant */
        foreach ($participants as $participant) {
            $participant->setRace($this);
        }
    }

    /**
     * @return Participant[]|ArrayCollection
     */
    public function getActiveParticipants(): ArrayCollection
    {
        return $this->getParticipants()->filter(function (Participant $participant) {
           return $participant->isActive();
        });
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getBestTime(): int
    {
        return $this->bestTime;
    }

    /**
     * @param int $bestTime
     */
    public function setBestTime(int $bestTime): void
    {
        $this->bestTime = $bestTime;
    }

    /**
     * @return int
     */
    public function getCurrentTime(): int
    {
        return $this->currentTime;
    }

    /**
     * @param int $currentTime
     */
    public function setCurrentTime(int $currentTime): void
    {
        $this->bestTime = $currentTime;
    }

    /**
     * @return Horse
     */
    public function getLeader(): Horse
    {
        return $this->leader;
    }

    /**
     * @param Horse $leader
     */
    public function setLeader(Horse $leader): void
    {
        $this->leader = $leader;
    }

    /**
     * @return int
     */
    public function getDistance(): int
    {
        return $this->distance;
    }

    /**
     * @param int $distance
     */
    public function setDistance(int $distance): void
    {
        $this->distance = $distance;
    }
}