<?php

namespace  App\Tests\Repository;

use App\Entity\Horse;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HorseRepositoryTest extends KernelTestCase
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * SetUp HorseRepositoryTest
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * GetAvailableHorses Test
     */
    public function testGetAvailableHorses()
    {
        $numberOfHorses = 8;

        /** @var Horse[] $horses */
        $horses = $this->em
            ->getRepository(Horse::class)
            ->getAvailableList($numberOfHorses);

        $this->assertContainsOnlyInstancesOf(Horse::class, $horses);
        $this->assertCount($numberOfHorses, $horses);
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