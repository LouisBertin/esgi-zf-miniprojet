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
     * @return array
     */
    public function getAllActive() : array
    {
        try {
            $qb = $this->getEntityManager()->createQueryBuilder();
            $qb
                ->select(['m.id', 'm.title', 'm.startingDate'])
                ->where('m.is_active = 1')
                ->from($this->getEntityName() ,'m');
            $results = $qb->getQuery()->getResult();
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

        return $results;
    }
}