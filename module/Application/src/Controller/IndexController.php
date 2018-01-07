<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Form\ContactForm;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mail\Message;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mail\Transport\Sendmail as SendmailTransport;

class IndexController extends AbstractActionController
{
    /** @var ContactForm */
    private $contactForm;

    public function __construct(ContactForm $contactForm)
    {
        $this->contactForm = $contactForm;
    }

    /**
     * @return ViewModel
     */
    public function indexAction() : ViewModel
    {
        return new ViewModel();
    }

    /**
     * @return ViewModel
     */
    public function contactAction() : ViewModel
    {
        $form = $this->contactForm;
        $form->prepare();

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
              $message = new Message();
              $message->addFrom($request->getPost()['email'], $request->getPost()['lastname'].' '.$request->getPost()['firstname']);
              $message->addTo('bertin.louis7@gmail.com');
              $message->setSubject('Sending an email from Zend\Mail!');
              $message->setBody('This is the message body.');

              $transport = new SendmailTransport();
              $transport->send($message);
            }
        }

        return new ViewModel(['form' => $form]);
    }
}
