<?php

namespace Application\Form;

use Application\Validator\DateCompare;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\InputFilter\InputFilterProviderInterface;
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

        $startingDate = new Text('startingDate');
        $startingDate->setLabel('Starting Date');
        $startingDate->setAttribute('class', 'datepicker');
        $this->add($startingDate);

        $endingDate = new Text('endingDate');
        $endingDate->setLabel('Ending Date');
        $endingDate->setAttribute('class', 'datepicker');
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
                            'max' => 50
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
                        'name' => DateCompare::class,
                        'options' => array(
                            'compareWith' => 'startingDate',
                            'comparisonOperator' => '>='
                        ),
                    ]
                ]
            ]
        ];
    }
}
