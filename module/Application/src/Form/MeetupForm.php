<?php

namespace Application\Form;

use Zend\Form\Element\Submit;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\Callback;
use Zend\Validator\StringLength;

class MeetupForm extends Form implements InputFilterProviderInterface
{
    /**
     * MeetupForm constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setAttribute('method', 'post');

        $title = new Text('title');
        $title->setLabel('Title');
        $this->add($title);

        $title = new Textarea('description');
        $title->setLabel('Description');
        $this->add($title);

        $startingDate = new \Zend\Form\Element\Date('startingDate');
        $startingDate->setLabel('Starting Date');
/*        $startingDate->setAttribute('data-toggle', 'datepicker');*/
        $this->add($startingDate);

        $endingDate = new \Zend\Form\Element\Date('endingDate');
        $endingDate->setLabel('Ending Date');
        /*        $startingDate->setAttribute('data-toggle', 'datepicker');*/
        $this->add($endingDate);

        $submit = new Submit('submit');
        $submit->setValue('Submit');
        $submit->setAttribute('value', 'Create');
        $this->add($submit);
    }

    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 30
                        ]
                    ]
                ]
            ],
            'description' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 5,
                            'max' => 200
                        ]
                    ]
                ]
            ],
            'endingDate' => [
                'validators' => [
                    [
                        'name' => Callback::class,
                        'options' => array(
                            'messages' => array(
                                Callback::INVALID_VALUE => 'The end date should be greater than start date',
                            ),
                            'callback' => function($value, $context = array()) {
                                $startDate = \DateTime::createFromFormat('Y-m-d', $context['startingDate']);
                                $endDate = \DateTime::createFromFormat('Y-m-d', $value);
                                return $endDate >= $startDate;
                            },
                        ),
                    ]
                ]
            ]
        ];
    }
}