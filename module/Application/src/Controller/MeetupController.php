<?php

namespace Application\Controller;


use Application\Repository\MeetupRepository;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class MeetupController extends AbstractActionController
{
    /** @var MeetupRepository $meetupRepository */
    private $meetupRepository;

    /**
     * MeetupController constructor.
     * @param MeetupRepository $meetupRepository
     */
    public function __construct(MeetupRepository $meetupRepository)
    {
        $this->meetupRepository = $meetupRepository;
    }

    /**
     * view to show meeting
     * @return ViewModel
     */
    public function showAction()
    {
        $meetups = $this->meetupRepository->getMeetup();

        return new ViewModel(['meetups' => $meetups]);
    }

    /**
     * view to add meeting
     * @return ViewModel
     */
    public function addAction()
    {
        return new ViewModel();
    }
}