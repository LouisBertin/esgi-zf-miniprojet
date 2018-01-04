<?php

namespace Application\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MeetupController extends AbstractActionController
{
    /**
     * view to show meeting
     * @return ViewModel
     */
    public function showAction()
    {
        return new ViewModel();
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