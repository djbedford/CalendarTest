<?php namespace Calendar;

use DateTimeInterface;

class Calendar implements CalendarInterface {

    /**
     * @param DateTimeInterface $datetime
     */
    public function __construct(DateTimeInterface $datetime) {
        parent::__construct($datetime);
    }

    /**
     * Get the day
     *
     * @return int
     */
    public function getDay() {
        // TODO: Implement getDay() method.
    }

    /**
     * Get the weekday (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getWeekDay() {
        // TODO: Implement getWeekDay() method.
    }

    /**
     * Get the first weekday of this month (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getFirstWeekDay() {
        // TODO: Implement getFirstWeekDay() method.
    }

    /**
     * Get the first week of this month (18th March => 9 because March starts on week 9)
     *
     * @return int
     */
    public function getFirstWeek() {
        // TODO: Implement getFirstWeek() method.
    }

    /**
     * Get the number of days in this month
     *
     * @return int
     */
    public function getNumberOfDaysInThisMonth() {
        // TODO: Implement getNumberOfDaysInThisMonth() method.
    }

    /**
     * Get the number of days in the previous month
     *
     * @return int
     */
    public function getNumberOfDaysInPreviousMonth() {
        // TODO: Implement getNumberOfDaysInPreviousMonth() method.
    }

    /**
     * Get the calendar array
     *
     * @return array
     */
    public function getCalendar() {
        // TODO: Implement getCalendar() method.
    }
}
