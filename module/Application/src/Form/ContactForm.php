<?php

namespace Application\Form;

use Zend\Form\Element\Email;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\EmailAddress;
use Zend\Validator\StringLength;

/**
 * Class ContactForm
 * @package Application\Form
 */
class ContactForm extends Form implements InputFilterProviderInterface
{
    /**
     * ContactForm constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setAttribute('method', 'post');

        $lastname = new Text('lastname');
        $lastname->setLabel('Lastname');
        $this->add($lastname);

        $firstname = new Text('firstname');
        $firstname->setLabel('Firstname');
        $this->add($firstname);

        $email = new Email('email');
        $email->setLabel('Email');
        $this->add($email);

        $message = new Textarea('message');
        $message->setLabel('Message');
        $this->add($message);

        $submit = new Submit('submit');
        $submit->setValue('Send');
        $this->add($submit);
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification() : array
    {
        return [
            'lastname' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 100
                        ]
                    ]
                ]
            ],
            'firstname' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 100
                        ]
                    ]
                ]
            ],
            'message' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 300
                        ]
                    ]
                ]
            ],
            'email' => [
                'validators' => [
                    [
                        'name' => EmailAddress::class
                    ]
                ]
            ],
        ];
    }
}