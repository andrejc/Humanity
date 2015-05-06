<?php

namespace RecurringEvents\RecurringTypes;

/*
 * Allows users to define custom recurring types.
 */
class CustomRecurringType implements RecurringTypeInterface {

    private $period;
    private $daysOfWeek;

    function __construct($period, $daysOfWeek = null) {
        $this->period     = $period;
        $this->daysOfWeek = $daysOfWeek;
    }

    /**
     * @return int
     */
    public function getPeriod() {
        return $this->period;
    }

    /**
     * @return int[]
     */
    public function getDaysOfWeek() {
        return $this->daysOfWeek;
    }
}