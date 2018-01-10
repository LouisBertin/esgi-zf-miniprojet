<?php

namespace Application\Repository;

use Application\Entity\Meetup;
use Application\Entity\Organizer;
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
                ->select(['m.id', 'm.title', 'm.startingDate', 'm.img'])
                ->where('m.is_active = 1')
                ->from($this->getEntityName(), 'm');
            $results = $qb->getQuery()->getResult();
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

        return $results;
    }

    /**
     * @param int $id
     * @return Meetup
     */
    public function getById(int $id) : Meetup
    {
        $meetup = $this->find($id);

        return $meetup;
    }

    /**
     * @param string $key
     * @param string $value
     * @return Meetup
     */
    public function getBy(string $key, string $value) : Meetup
    {
        $meetup = $this->findOneBy([],[$key => $value]);

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
     * @param string $endingDate
     * @param string $img
     * @param string $organizer
     * @return Meetup
     */
    public function create(string $title, string $description, string $startingDate, string $endingDate, string $img, string $organizer) : Meetup
    {
        $startingDate = new \DateTime($startingDate);
        $endingDate = new \DateTime($endingDate);
        /** @var OrganizerRepository $organizerRepository */
        $organizerRepository = $this->getEntityManager()->getRepository(Organizer::class);
        /** @var Organizer $organizer */
        $organizer = $organizerRepository->findById($organizer);
        /** @var Meetup $meetup */
        $meetup = new Meetup($title, $description, $startingDate, $endingDate, $img);
        $meetup->addOrganizer($organizer);

        return $meetup;
    }

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param string $startingDate
     * @param string $endingDate
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function edit(int $id, string $title, string $description, string $startingDate, string $endingDate, $fileName) : void
    {
        $em = $this->getEntityManager();
        $meetup = $this->getById($id);

        $meetup->setTitle($title);
        $meetup->setDescription($description);
        $meetup->setStartingDate(\DateTime::createFromFormat('d/m/Y', $startingDate));
        $meetup->setEndingDate(\DateTime::createFromFormat('d/m/Y', $endingDate));
        $meetup->setImg($fileName);

        $em->flush();
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
