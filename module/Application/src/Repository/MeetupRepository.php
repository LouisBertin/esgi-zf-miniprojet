<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class MeetupRepository
 * @package Application\Repository
 */
final class MeetupRepository extends EntityRepository
{
    /**
     * return meetups
     * @return array
     */
    public function getMeetup()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select(['m.id', 'm.title', 'm.startingDate'])
            ->from($this->getEntityName() ,'m');
        $results = $qb->getQuery()->getScalarResult();

        return $results;
    }

    public function getMeetupById()
    {

    }
}