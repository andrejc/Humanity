<?php

namespace RecurringEvents\RecurringTypes;

class MwfRecurringType implements RecurringTypeInterface {

    public function getPeriod() {
        return 1;
    }

    public function getDaysOfWeek() {
        return array(self::DAY_MONDAY, self::DAY_WEDNESDAY, self::DAY_FRIDAY);
    }
}