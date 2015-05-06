<?php

use RecurringEvents\RecurringEvent;
use RecurringEvents\RecurringTypes\CustomRecurringType;
use RecurringEvents\RecurringTypes\DailyRecurringType;
use RecurringEvents\RecurringTypes\MwfRecurringType;
use RecurringEvents\RecurringTypes\WeeklyRecurringType;

class RecurringEventTest extends PHPUnit_Framework_TestCase {
    /*
     * Test daily event without limit
     */
    public function testUnlimitedDailyEvent() {
        $recEvent = new RecurringEvent(new DateTime("2014-01-01"), new DailyRecurringType());
        $events = $recEvent->generateEventDates(new DateTime("2015-01-01"), new DateTime("2015-01-31"));

        $this->assertCount(31, $events);
        $this->assertEquals($events[0]->format('Y-m-d'), '2015-01-01');
        $this->assertEquals($events[30]->format('Y-m-d'), '2015-01-31');
    }

    /*
     * Test weekly event without limit
     */
    public function testUnlimitedWeeklyEvent() {
        $recEvent = new RecurringEvent(new DateTime("2014-01-01"), new WeeklyRecurringType());
        $events = $recEvent->generateEventDates(new DateTime("2015-01-01"), new DateTime("2015-01-31"));

        $this->assertCount(5, $events);
        $this->assertEquals($events[0]->format('Y-m-d'), '2015-01-01');
        $this->assertEquals($events[1]->format('Y-m-d'), '2015-01-08');
        $this->assertEquals($events[2]->format('Y-m-d'), '2015-01-15');
        $this->assertEquals($events[3]->format('Y-m-d'), '2015-01-22');
        $this->assertEquals($events[4]->format('Y-m-d'), '2015-01-29');
    }

    /*
     * Test Monday-Wednesday-Friday event without limit
     */
    public function testUnlimitedMwfEvent() {
        $recEvent = new RecurringEvent(new DateTime("2014-01-01"), new MwfRecurringType());
        $events = $recEvent->generateEventDates(new DateTime("2015-01-05"), new DateTime("2015-01-19"));

        $this->assertCount(7, $events);
        $this->assertEquals($events[0]->format('Y-m-d'), '2015-01-05');
        $this->assertEquals($events[1]->format('Y-m-d'), '2015-01-07');
        $this->assertEquals($events[2]->format('Y-m-d'), '2015-01-09');
        $this->assertEquals($events[3]->format('Y-m-d'), '2015-01-12');
        $this->assertEquals($events[4]->format('Y-m-d'), '2015-01-14');
        $this->assertEquals($events[5]->format('Y-m-d'), '2015-01-16');
        $this->assertEquals($events[6]->format('Y-m-d'), '2015-01-19');
    }

    /*
     * Test custom recurring type (period of 10 days, skipping weekends) without limit
     */
    public function testUnlimitedCustomEvent() {
        $workingDays = array(CustomRecurringType::DAY_MONDAY, CustomRecurringType::DAY_TUESDAY, CustomRecurringType::DAY_WEDNESDAY,
            CustomRecurringType::DAY_THURSDAY, CustomRecurringType::DAY_FRIDAY);
        $recEvent = new RecurringEvent(new DateTime("2014-01-01"), new CustomRecurringType(10, $workingDays));
        $events = $recEvent->generateEventDates(new DateTime("2015-01-01"), new DateTime("2015-01-31"));

        $this->assertCount(2, $events);
        $this->assertEquals($events[0]->format('Y-m-d'), '2015-01-01');
        $this->assertEquals($events[1]->format('Y-m-d'), '2015-01-21');
    }

    /*
     * Test limit by date
     */
    public function testDailyEventLimitedByDate() {
        $recEvent = new RecurringEvent(new DateTime("2014-01-01"), new DailyRecurringType(), new DateTime("2015-01-15"));
        $events = $recEvent->generateEventDates(new DateTime("2015-01-01"), new DateTime("2015-01-31"));

        $this->assertCount(15, $events);
        $this->assertEquals($events[0]->format('Y-m-d'), '2015-01-01');
        $this->assertEquals($events[14]->format('Y-m-d'), '2015-01-15');
    }

    /*
     * Test limit by number of repetitions
     */
    public function testDailyEventLimitedByRepetitions() {
        $recEvent = new RecurringEvent(new DateTime("2014-01-01"), new DailyRecurringType(), null, 5);
        $events = $recEvent->generateEventDates(new DateTime("2015-01-01"), new DateTime("2015-01-31"));

        $this->assertCount(5, $events);
        $this->assertEquals($events[0]->format('Y-m-d'), '2015-01-01');
        $this->assertEquals($events[1]->format('Y-m-d'), '2015-01-02');
        $this->assertEquals($events[2]->format('Y-m-d'), '2015-01-03');
        $this->assertEquals($events[3]->format('Y-m-d'), '2015-01-04');
        $this->assertEquals($events[4]->format('Y-m-d'), '2015-01-05');
    }
}