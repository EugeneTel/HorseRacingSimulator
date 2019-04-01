<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Participant
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="participant")
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 */
class Participant extends AbstractEntity
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Race
     *
     * @ORM\ManyToOne(targetEntity="Race", inversedBy="participants", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;
    /**
     * @var Horse
     *
     * @ORM\ManyToOne(targetEntity="Horse", inversedBy="participate", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $horse;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=1)
     */
    private $distance = 0;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $time = 0;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint")
     */
    private $position = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $active = 1;

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
     * @return Race
     */
    public function getRace(): Race
    {
        return $this->race;
    }

    /**
     * @param Race $race
     */
    public function setRace(Race $race): void
    {
        $this->race = $race;
    }

    /**
     * @return Horse
     */
    public function getHorse(): Horse
    {
        return $this->horse;
    }

    /**
     * @param Horse $horse
     */
    public function setHorse(Horse $horse): void
    {
        $this->horse = $horse;
    }

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     */
    public function setDistance(float $distance): void
    {
        $this->distance = $distance;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @param int $time
     */
    public function setTime(int $time): void
    {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
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