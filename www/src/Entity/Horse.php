<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Horse
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="horse")
 * @ORM\Entity(repositoryClass="App\Repository\HorseRepository")
 */
class Horse extends AbstractEntity
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
     * @var string
     *
     * @ORM\Column(type="string", unique=true, length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=1)
     */
    private $speed;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=1)
     */
    private $strength;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=1)
     */
    private $endurance;

    /**
     * @var Participant[]|ArrayCollection
     *
     * @ORM\OneToMany(
     *      targetEntity="Participant",
     *      mappedBy="horse",
     *      orphanRemoval=true,
     *      cascade={"persist"}
     * )
     */
    private $participate;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * Horse constructor.
     */
    public function __construct()
    {
        $this->participate = new ArrayCollection();
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }

    /**
     * @param float $speed
     */
    public function setSpeed(float $speed): void
    {
        $this->speed = $speed;
    }

    /**
     * @return float
     */
    public function getStrength(): float
    {
        return $this->strength;
    }

    /**
     * @param float $strength
     */
    public function setStrength(float $strength): void
    {
        $this->strength = $strength;
    }

    /**
     * @return float
     */
    public function getEndurance(): float
    {
        return $this->endurance;
    }

    /**
     * @param float $endurance
     */
    public function setEndurance(float $endurance): void
    {
        $this->endurance = $endurance;
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