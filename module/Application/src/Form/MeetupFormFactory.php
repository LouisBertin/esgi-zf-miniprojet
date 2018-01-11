<?php

namespace Application\Form;

use Application\Entity\Organizer;
use Application\Repository\OrganizerRepository;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class MeetupFormFactory
 * @package Application\Form
 */
class MeetupFormFactory
{
    /**
     * @param ContainerInterface $container
     * @return MeetupForm
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : MeetupForm
    {
        /** @var EntityManager $em */
        $em = $container->get(EntityManager::class);
        /** @var OrganizerRepository $organizerRepository */
        $organizerRepository = $em->getRepository(Organizer::class);

        return new MeetupForm($organizerRepository);
    }
}
