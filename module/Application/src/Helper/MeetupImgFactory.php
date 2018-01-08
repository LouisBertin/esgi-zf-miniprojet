<?php

namespace Application\Helper;

use Psr\Container\ContainerInterface;
use Zend\View\Renderer\RendererInterface;

/**
 * Class MeetupImgFactory
 * @package Application\Helper
 */
final class MeetupImgFactory
{
    /**
     * @param ContainerInterface $container
     * @return MeetupImg
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : MeetupImg
    {
        $renderer = $container->get(RendererInterface::class);
        $meetupImgDirectory = explode('/', $container->get('config')['upload_path']);
        $meetupImgDirectory = $meetupImgDirectory[1] . '/' . $meetupImgDirectory[2] . '/';

        $baseUrl = $renderer->basePath($meetupImgDirectory);

        return new MeetupImg($baseUrl);
    }
}
