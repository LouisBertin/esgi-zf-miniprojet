<?php

namespace Application\Controller;


use Application\Entity\Meeting;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;

final class MeetupControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var EntityManager $em */
        $em = $container->get(EntityManager::class);
        $meetupRepository = $em->getRepository(Meeting::class);

        return new MeetupController($meetupRepository);
    }
}