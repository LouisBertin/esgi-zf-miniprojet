<?php
/**
 * Created by IntelliJ IDEA.
 * User: louisbertin
 * Date: 07/01/2018
 * Time: 01:18
 */

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Form\ContactForm;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class IndexControllerFactory
 * @package Application\Controller
 */
final class IndexControllerFactory
{
    /**
     * @param ContainerInterface $container
     * @return IndexController
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var ContactForm $contactForm */
        $contactForm = $container->get(ContactForm::class);
        /** @var EntityManager $em */
        $em = $container->get(EntityManager::class);
        /** @var Meetup $meetupRepository */
        $meetupRepository = $em->getRepository(Meetup::class);

        return new IndexController($contactForm, $meetupRepository);
    }
}
