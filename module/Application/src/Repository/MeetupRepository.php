<?php

namespace Application\Repository;

use Application\Entity\Meetup;
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
     * @param Meetup $meetup
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add(Meetup $meetup) : void
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush();
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $startingDate
     * @return Meetup
     */
    public function createMeetupFromTitleAndDesc(string $title, string $description, string $startingDate) : Meetup
    {
        $startingDate = new \DateTime($startingDate);
        $endingDate = $startingDate;
        return new Meetup($title, $description, $startingDate, $endingDate);
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