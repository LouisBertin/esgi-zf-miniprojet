<?php

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Form\MeetupEditForm;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Application\Form\MeetupForm;

/**
 * Class MeetupControllerFactory
 * @package Application\Controller
 */
final class MeetupControllerFactory
{
    /**
     * @param ContainerInterface $container
     * @return MeetupController
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var EntityManager $em */
        $em = $container->get(EntityManager::class);
        /** @var MeetupRepository $meetupRepository */
        $meetupRepository = $em->getRepository(Meetup::class);
        /** @var MeetupForm $meetupForm */
        $meetupForm = $container->get(MeetupForm::class);
        /** @var $meetupEditForm $meetupEditForm */
        $meetupEditForm = $container->get(MeetupEditForm::class);
        /** @var string $upload_path */
        $upload_path = $container->get('config')['upload_path'];

        return new MeetupController($meetupRepository, $meetupForm, $meetupEditForm, $upload_path);
    }
}
