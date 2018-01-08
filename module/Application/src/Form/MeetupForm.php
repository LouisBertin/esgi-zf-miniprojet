<?php

namespace Application\Form;

use Application\Validator\DateCompare;
use Zend\Form\Element\File;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\File\Extension;
use Zend\Validator\File\ImageSize;
use Zend\Validator\File\IsImage;
use Zend\Validator\StringLength;

/**
 * Class MeetupForm
 * @package Application\Form
 */
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

        $file = new File('img');
        $file->setLabel('img');
        $this->add($file);

        $submit = new Submit('submit');
        $submit->setValue('Submit');
        $submit->setAttribute('value', 'Create');
        $this->add($submit);
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification() : array
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
            ],
            'img' => [
                'validators' => [
                    [
                        'name' => ImageSize::class,
                        'options' => [
                            'maxwidth' => 1920,
                            'maxHeight' => 1080
                        ],
                        'name' => IsImage::class,
                        'name' => Extension::class,
                        'options' => [
                            'extension' => 'png, jpg, jpeg'
                        ]
                    ]
                ]
            ]
        ];
    }
}
