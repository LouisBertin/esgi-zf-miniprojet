<?php

namespace Application\Repository;

use Application\Entity\Organizer;
use Doctrine\ORM\EntityRepository;

/**
 * Class OrganizerRepository
 * @package Application\Repository
 */
final class OrganizerRepository extends EntityRepository
{
    /**
     * @param Organizer $organizer
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add(Organizer $organizer) : void
    {
        $this->getEntityManager()->persist($organizer);
        $this->getEntityManager()->flush();
    }

    /**
     * @param string $lastname
     * @param string $firstname
     * @param string $email
     * @return Organizer
     */
    public function create(string $lastname, string $firstname, string $email) : Organizer
    {
        return new Organizer($lastname, $firstname, $email);
    }

    /**
     * @param string $id
     * @return object
     */
    public function findById(string $id) : object
    {
        return $this->find($id);
    }

    /**
     * @return array
     */
    public function getAll() : array
    {
        try {
            $qb = $this->getEntityManager()->createQueryBuilder();
            $qb
                ->select(['o.id', 'o.lastname'])
                ->from($this->getEntityName(), 'o');
            $results = $qb->getQuery()->getResult();
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

        return $results;
    }

    /**
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteById(int $id) : void
    {
        $organizer = $this->find($id);

        $this->getEntityManager()->remove($organizer);
        $this->getEntityManager()->flush();
    }
}
