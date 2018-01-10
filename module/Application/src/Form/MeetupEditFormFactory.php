<?php

namespace Application\Form;
use Application\Entity\Organizer;
use Application\Repository\OrganizerRepository;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class MeetupEditFormFactory
 * @package Application\Form
 */
class MeetupEditFormFactory
{
    /**
     * @param ContainerInterface $container
     * @return MeetupEditForm
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : MeetupEditForm
    {
        /** @var EntityManager $em */
        $em = $container->get(EntityManager::class);
        /** @var OrganizerRepository $organizerRepository */
        $organizerRepository = $em->getRepository(Organizer::class);

        return new MeetupEditForm($organizerRepository);
    }
}