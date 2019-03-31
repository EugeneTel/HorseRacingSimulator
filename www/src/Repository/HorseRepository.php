<?php

namespace App\Repository;

use App\Entity\Horse;
use Doctrine\ORM\EntityRepository;

class HorseRepository extends EntityRepository
{
    /**
     * Get available horses list
     *
     * @param int $number number of horses
     * @return Horse[]
     */
    public function getAvailableList(int $number): array
    {

        $qb = $this->createQueryBuilder('h')
            ->where('h.active = 1')
            ->orderBy('RAND()')
            ->setMaxResults($number);

        return $qb->getQuery()->getResult();
    }
}