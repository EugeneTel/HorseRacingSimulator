<?php

namespace  App\Tests\Repository;

use App\Collection\ParticipantCollection;
use App\Entity\Participant;
use App\Service\ParticipantManager;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ParticipantManagerTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var ParticipantManager
     */
    private $participantManager;

    /**
     * SetUp HorseRepositoryTest
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->participantManager = new ParticipantManager($this->em);
    }

    /**
     * prepareParticipants Test
     */
    public function testPrepareParticipants()
    {
        $numberOfParticipants = 8;

        $participants = $this->participantManager->prepareParticipants($numberOfParticipants);

        $this->participantManager->releaseParticipants($participants);

        $this->assertInstanceOf(ParticipantCollection::class, $participants);
        $this->assertContainsOnlyInstancesOf(Participant::class, $participants);
        $this->assertCount($numberOfParticipants, $participants);
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