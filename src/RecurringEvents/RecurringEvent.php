<?php

namespace RecurringEvents;

use DateTime;
use RecurringEvents\RecurringTypes\RecurringTypeInterface;

/*
 * Defines recurring event by initial date and recurring type.
 * Event recurrence can be optionally limited by either a preset date or number of repetitions.
 */
class RecurringEvent {

    private $startDate;
    private $recurringType;
    private $dateLimit;
    private $repetitionLimit;

    function __construct($startDate, $recurringType, $dateLimit = null, $repetitionLimit = null) {
        $this->startDate       = $startDate;
        $this->recurringType   = $recurringType;
        $this->dateLimit       = $dateLimit;
        $this->repetitionLimit = $repetitionLimit;
    }

    /**
     * Generates an array of DateTime objects corresponding to this recurring event.
     *
     * @param DateTime $rangeStartDate
     * @param DateTime $rangeEndDate
     * @return DateTime[]
     */
    function generateEventDates($rangeStartDate, $rangeEndDate) {
        $curDate   = $this->startDate > $rangeStartDate ? $this->startDate : $rangeStartDate;
        $limitDate = $this->dateLimit != null && $this->dateLimit < $rangeEndDate ? $this->dateLimit : $rangeEndDate;

        $allowedDaysOfWeek = $this->recurringType->getDaysOfWeek();
        $repetitionPeriod  = $this->recurringType->getPeriod();
        $eventDates        = array();

        while($curDate <= $limitDate && ($this->repetitionLimit == null || count($eventDates) < $this->repetitionLimit)) {
            if($allowedDaysOfWeek != null){
                $curDayOfWeek = date('w', $curDate->getTimestamp());

                if(in_array($curDayOfWeek, $allowedDaysOfWeek)) {
                    $eventDates[] = clone($curDate);
                }
            }
            else {
                $eventDates[] = clone($curDate);
            }

            $periodString = 'P' . $repetitionPeriod . 'D';
            $curDate = $curDate->add(new \DateInterval($periodString));
        }

        return $eventDates;
    }

    /**
     * @return RecurringTypeInterface
     */
    public function getRecurringType()
    {
        return $this->recurringType;
    }

    /**
     * @param RecurringTypeInterface $recurringType
     */
    public function setRecurringType($recurringType)
    {
        $this->recurringType = $recurringType;
    }

    /**
     * @return DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return DateTime
     */
    public function getDateLimit()
    {
        return $this->dateLimit;
    }

    /**
     * @param DateTime $dateLimit
     */
    public function setDateLimit($dateLimit)
    {
        $this->dateLimit = $dateLimit;
    }

    /**
     * @return int
     */
    public function getRepetitionLimit()
    {
        return $this->repetitionLimit;
    }

    /**
     * @param int $repetitionLimit
     */
    public function setRepetitionLimit($repetitionLimit)
    {
        $this->repetitionLimit = $repetitionLimit;
    }
}