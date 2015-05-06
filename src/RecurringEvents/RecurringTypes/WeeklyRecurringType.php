<?php

namespace RecurringEvents\RecurringTypes;

class WeeklyRecurringType implements RecurringTypeInterface {

    public function getPeriod()
    {
        return 7;
    }

    public function getDaysOfWeek()
    {
        return null;
    }
}