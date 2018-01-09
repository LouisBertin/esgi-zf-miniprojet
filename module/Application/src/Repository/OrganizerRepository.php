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
}