<?php

namespace Application\Repository;

use Application\Entity\Meeting;
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

    /**
     * @param int $id
     * @return null|object
     */
    public function getById(int $id)
    {
        $meetup = $this->find($id);

        return $meetup;
    }

    /**
     * @param Meeting $meeting
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add(Meeting $meeting) : void
    {
        $this->getEntityManager()->persist($meeting);
        $this->getEntityManager()->flush();
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $startingDate
     * @return Meeting
     */
    public function createMeetupFromTitleAndDesc(string $title, string $description, string $startingDate) : Meeting
    {
        $startingDate = new \DateTime($startingDate);
        $endingDate = $startingDate;
        return new Meeting($title, $description, $startingDate, $endingDate);
    }

    /**
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteById(int $id) : void
    {
        $meetup = $this->getById($id);

        $this->getEntityManager()->remove($meetup);
        $this->getEntityManager()->flush();
    }
}