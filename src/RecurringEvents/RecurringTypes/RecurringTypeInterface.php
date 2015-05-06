<?php

namespace RecurringEvents\RecurringTypes;

/*
 * Recurring type interface defines events by recurrence period (e.g. 7 days)
 * and optional list of allowed days of week (e.g. Monday, Wednesday, Friday).
 */
interface RecurringTypeInterface {
    const DAY_SUNDAY    = 0;
    const DAY_MONDAY    = 1;
    const DAY_TUESDAY   = 2;
    const DAY_WEDNESDAY = 3;
    const DAY_THURSDAY  = 4;
    const DAY_FRIDAY    = 5;
    const DAY_SATURDAY  = 6;

    public function getPeriod();
    public function getDaysOfWeek();
}