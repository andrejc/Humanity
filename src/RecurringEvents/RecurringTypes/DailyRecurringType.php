<?php

namespace RecurringEvents\RecurringTypes;

class DailyRecurringType implements RecurringTypeInterface {

    public function getPeriod()
    {
        return 1;
    }

    public function getDaysOfWeek()
    {
        return null;
    }
}