<?php

namespace Application\Form;

use Zend\Form\Element\Submit;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;
use Zend\Form\Element\Text;

class MeetupForm extends Form
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
        $startingDate->setAttribute('data-toggle', 'datepicker');
        $this->add($startingDate);

        $submit = new Submit('submit');
        $submit->setValue('Submit');
        $submit->setAttribute('value', 'Create');
        $this->add($submit);
    }
}