<?php

namespace Application\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Class MeetupImg
 * @package Application\Helper
 */
final class MeetupImg extends AbstractHelper
{
    /** @var string $basePath */
    private $basePath;

    /**
     * MeetupImg constructor.
     * @param string $basePath
     */
    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @param string $url
     * @return string
     */
    public function __invoke(string $url) : string
    {
        return $this->basePath . $url;
    }
}