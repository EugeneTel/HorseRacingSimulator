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
    const NUMBER_OF_HORSES = 8;

    /** @var int */
    const DISTANCE = 1500;

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
    public function getParticipants()
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
}