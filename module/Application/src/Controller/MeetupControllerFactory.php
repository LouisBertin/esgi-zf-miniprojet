<?php

namespace Application\Controller;

use Application\Entity\Meetup;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Application\Form\MeetupForm;

final class MeetupControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var EntityManager $em */
        $em = $container->get(EntityManager::class);
        $meetupRepository = $em->getRepository(Meetup::class);
        /** @var \MeetupForm $meetupForm */
        $meetupForm = $container->get(MeetupForm::class);

        return new MeetupController($meetupRepository, $meetupForm);
    }
}
