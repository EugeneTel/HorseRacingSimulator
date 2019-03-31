<?php

namespace  App\Tests\Repository;

use App\Entity\Race;
use App\Service\ParticipantManager;
use App\Service\RaceManager;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RaceManagerTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var RaceManager
     */
    private $raceManager;

    /**
     * SetUp HorseRepositoryTest
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->raceManager = new RaceManager($this->em);
    }

    /**
     * createRace Test
     */
    public function testCreateRace()
    {
        $numberOfParticipants = 8;

        $participantManager = new ParticipantManager($this->em);

        $participants = $participantManager->prepareParticipants($numberOfParticipants);

        $race = $this->raceManager->create($participants);

        $this->assertInstanceOf(Race::class, $race);
        $this->assertCount($numberOfParticipants, $race->getParticipants());
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}