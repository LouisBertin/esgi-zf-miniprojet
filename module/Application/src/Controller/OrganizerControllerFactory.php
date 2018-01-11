<?php

namespace Application\Controller;

use Application\Entity\Organizer;
use Application\Form\OrganizerForm;
use Application\Repository\OrganizerRepository;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class OrganizerControllerFactory
 * @package Application\Controller
 */
final class OrganizerControllerFactory
{
    /**
     * @param ContainerInterface $container
     * @return OrganizerController
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : OrganizerController
    {
        /** @var OrganizerForm $organizerForm */
        $organizerForm = $container->get(OrganizerForm::class);
        /** @var EntityManager $em */
        $em = $container->get(EntityManager::class);
        /** @var OrganizerRepository $organizerRepository */
        $organizerRepository = $em->getRepository(Organizer::class);

        return new OrganizerController($organizerForm, $organizerRepository);
    }
}
