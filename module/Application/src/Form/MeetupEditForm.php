<?php

namespace Application\Form;

use Application\Validator\DateCompare;
use Zend\Form\Element\File;
use Zend\Form\Element\Select;
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
 * Class MeetupEditForm
 * @package Application\Form
 */
class MeetupEditForm extends Form implements InputFilterProviderInterface
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
        $title->setAttribute('class', 'form-control');
        $this->add($title);

        $description = new Textarea('description');
        $description->setLabel('Description');
        $description->setAttribute('class', 'form-control');
        $this->add($description);

        $startingDate = new Text('startingDate');
        $startingDate->setLabel('Starting Date');
        $startingDate->setAttribute('class', 'datepicker form-control');
        $this->add($startingDate);

        $endingDate = new Text('endingDate');
        $endingDate->setLabel('Ending Date');
        $endingDate->setAttribute('class', 'datepicker form-control');
        $this->add($endingDate);

        $organizer = new Select('organizer');
        $organizer->setLabel('Organizer');
        $organizer->setAttribute('class', 'form-control');
        $this->add($organizer);

        $file = new File('img');
        $file->setLabel('Meetup img');
        $file->setAttribute('class', 'form-control-file');
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
                'required' => false,
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
