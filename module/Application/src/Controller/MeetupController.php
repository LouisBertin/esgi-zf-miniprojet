<?php

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Form\MeetupForm;
use Application\Repository\MeetupRepository;
use Zend\Http\PhpEnvironment\Request;
use Zend\Http\Response;
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
    /** @var MeetupForm $meetupForm */
    private $meetupForm;
    /** @var string $upload_path */
    private $upload_path;

    /**
     * MeetupController constructor.
     * @param MeetupRepository $meetupRepository
     * @param MeetupForm $meetupForm
     * @param string $upload_path
     */
    public function __construct(MeetupRepository $meetupRepository, MeetupForm $meetupForm, string $upload_path)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
        $this->upload_path = $upload_path;
    }

    /**
     * show all meetup
     * @return ViewModel
     */
    public function showAction() : ViewModel
    {
        $meetups = $this->meetupRepository->getAllActive();

        return new ViewModel(['meetups' => $meetups]);
    }

    /**
     * @return ViewModel
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function addAction() : object
    {
        $form = $this->meetupForm;
        $form->prepare();

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $form->setData($data);

            if ($form->isValid()) {
                $extension = explode('.', $data['img']['name']);
                $extension = end($extension);
                $fileName = time() . '.' . $extension;

                if ($data['img']['error'] === 0) {
                    move_uploaded_file($data['img']['tmp_name'], $this->upload_path . $fileName);
                } else {
                    throw new \Exception('unknown error with img');
                }

                $meetup = $this->meetupRepository->create($data['title'], $data['description'], $data['startingDate'], $data['endingDate'], $fileName);
                $this->meetupRepository->add($meetup);

                return $this->redirect()->toRoute('meetup');
            }
        }

        return new ViewModel(['form' => $form]);
    }

    /**
     * @return ViewModel
     */
    public function viewAction() : ViewModel
    {
        $meetup = $this->meetupRepository->getById($this->params('id'));

        return new ViewModel(['meetup' => $meetup]);
    }

    /**
     * @return ViewModel
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editAction() : ViewModel
    {
        /** @var Meetup $meetup */
        $meetup = $this->meetupRepository->getById($this->params('id'));
        $form = $this->meetupForm;
        $form->prepare();
        $form->populateValues($meetup->toArray());

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->meetupRepository->edit($this->params('id'), $request->getPost()['title'], $request->getPost()['description'], $request->getPost()['startingDate'], $request->getPost()['endingDate']);

                return $this->redirect()->toRoute('meetup/edit', ['id' => $meetup->getId()]);
            }
        }

        return new ViewModel(['form' => $form]);
    }

    /**
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteAction() : Response
    {
        $this->meetupRepository->deleteById($this->params('id'));

        return $this->redirect()->toRoute('meetup');
    }
}
