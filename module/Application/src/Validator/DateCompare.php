<?php

namespace Application\Validator;

use Zend\Validator\AbstractValidator;

/**
 * Class DateCompare
 * @package Application\Validator
 */
class DateCompare extends AbstractValidator
{
    const INVALID_DATE = '';

    /**
     * @var array
     */
    protected $messageTemplates = [
        self::INVALID_DATE => 'The end date should be greater than start date'
    ];

    /**
     * @var array
     */
    protected $options = [
        'compareWith' => "",
        'comparisonOperator' => '>='
    ];

    /**
     * DateCompare constructor.
     * @param array $options
     */
    public function __construct($options = [])
    {
        parent::__construct($options);
    }

    /**
     * @return string
     */
    public function getCompareWith() : string
    {
        return $this->options['compareWith'];
    }

    /**
     * @return string
     */
    public function getComparisonOperator() : string
    {
        return $this->options['comparisonOperator'];
    }

    /**
     * @param mixed $value
     * @param array $context
     * @return bool
     */
    public function isValid($value, $context = []) : bool
    {
        $compareWith = $this->getCompareWith();
        $comparisonOperator = $this->getComparisonOperator();

        $startDate = \DateTime::createFromFormat('d/m/Y', $context[$compareWith]);
        $endDate = \DateTime::createFromFormat('d/m/Y', $value);

        if ($this->compareDate($endDate, $comparisonOperator, $startDate)) {
            return $this->compareDate($endDate, $comparisonOperator, $startDate);
        } else {
            $this->error(self::INVALID_DATE);
        }

        return $this->compareDate($endDate, $comparisonOperator, $startDate);
    }

    /**
     * @param $expr1
     * @param $operator
     * @param $expr2
     * @return bool
     */
    private function compareDate($expr1, $operator, $expr2) : bool
    {
        switch(strtolower($operator)) {
            case '==':
                return $expr1 == $expr2;
            case '>=':
                return $expr1 >= $expr2;
            case '<=':
                return $expr1 <= $expr2;
            case '>':
                return $expr1 > $expr2;
            case '<':
                return $expr1 < $expr2;
            default:
                return false;
        }
    }
}