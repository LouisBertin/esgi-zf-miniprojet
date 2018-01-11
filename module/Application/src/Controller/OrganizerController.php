<?php

namespace Application\Controller;

use Application\Entity\Organizer;
use Application\Form\OrganizerForm;
use Application\Repository\OrganizerRepository;
use Zend\Http\PhpEnvironment\Request;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class OrganizerController
 * @package Application\Controller
 */
class OrganizerController extends AbstractActionController
{
    /** @var OrganizerForm $organizerForm */
    private $organizerForm;
    /** @var OrganizerRepository $organizerRepository */
    private $organizerRepository;

    /**
     * OrganizerController constructor.
     * @param OrganizerForm $organizerForm
     */
    public function __construct(OrganizerForm $organizerForm, OrganizerRepository $organizerRepository)
    {
        $this->organizerForm = $organizerForm;
        $this->organizerRepository = $organizerRepository;
    }

    /**
     * @return object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addAction() : object
    {
        $form = $this->organizerForm;
        $form->prepare();

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost()->toArray();
            $form->setData($data);

            if ($form->isValid()) {
                /** @var Organizer $organizer */
                $organizer = $this->organizerRepository->create($data['lastname'], $data['firstname'], $data['email']);
                $this->organizerRepository->add($organizer);

                return $this->redirect()->toRoute('organizer/add');
            }
        }

        return new ViewModel(['form' => $form]);
    }

    /**
     * @return ViewModel
     */
    public function showAction() : ViewModel
    {
        /** @var array $organizers */
        $organizers = $this->organizerRepository->findAll();

        return new ViewModel(['organizers' => $organizers]);
    }

    /**
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteAction() : Response
    {
        $this->organizerRepository->deleteById($this->params('id'));

        return $this->redirect()->toRoute('organizer/show');
    }
}
