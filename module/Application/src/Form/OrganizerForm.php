<?php

namespace Application\Form;

use Zend\Form\Element\Email;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\EmailAddress;
use Zend\Validator\StringLength;

class OrganizerForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct();
        $this->setAttribute('method', 'post');

        $lastname = new Text('lastname');
        $lastname->setLabel('Lastname');
        $lastname->setAttribute('class', 'form-control');
        $this->add($lastname);

        $firstname = new Text('firstname');
        $firstname->setLabel('Firstname');
        $firstname->setAttribute('class', 'form-control');
        $this->add($firstname);

        $email = new Email('email');
        $email->setLabel('Email');
        $email->setAttribute('class', 'form-control');
        $this->add($email);

        $submit = new Submit('submit');
        $submit->setValue('Submit');
        $submit->setAttribute('value', 'Create');
        $this->add($submit);
    }

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
