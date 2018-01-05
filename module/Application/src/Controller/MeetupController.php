<?php

namespace Application\Controller;


use Application\Form\MeetupForm;
use Application\Repository\MeetupRepository;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class MeetupController
 * @package Application\Controller
 */
final class MeetupController extends AbstractActionController
{
    /** @var MeetupRepository $meetupRepository */
    private $meetupRepository;
    /** @var $meetupForm */
    private $meetupForm;

    /**
     * MeetupController constructor.
     * @param MeetupRepository $meetupRepository
     * @param MeetupForm $meetupForm
     */
    public function __construct(MeetupRepository $meetupRepository, MeetupForm $meetupForm)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
    }

    /**
     * show all meetup
     * @return ViewModel
     */
    public function showAction()
    {
        $meetups = $this->meetupRepository->getAllActive();

        return new ViewModel(['meetups' => $meetups]);
    }

    /**
     * @return ViewModel
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addAction()
    {
        $form = $this->meetupForm;
        $form->prepare();

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()){
            $form->setData($request->getPost());

            if ($form->isValid()){
                $meetup = $this->meetupRepository->createMeetupFromTitleAndDesc($request->getPost()['title'], $request->getPost()['description'], $request->getPost()['startingDate']);
                $this->meetupRepository->add($meetup);

                return $this->redirect()->toRoute('meetup');
            }
        }

        return new ViewModel(['form' => $form]);
    }

    /**
     * @return ViewModel
     */
    public function viewAction()
    {
        $meetup = $this->meetupRepository->getById($this->params('id'));

        return new ViewModel(['meetup' => $meetup]);
    }

    public function deleteAction()
    {
        $this->meetupRepository->deleteById($this->params('id'));

        return $this->redirect()->toRoute('meetup');
    }
}