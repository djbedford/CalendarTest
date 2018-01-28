<?php namespace Calendar;

use DateInterval;
use DateTimeInterface;

class Calendar implements CalendarInterface {
    protected $date;

    /**
     * @param DateTimeInterface $datetime
     */
    public function __construct(DateTimeInterface $datetime) {
        $this->date = $datetime;
    }

    /**
     * Get the day
     *
     * @return int
     */
    public function getDay() {
        return intval($this->date->format('j'));
    }

    /**
     * Get the weekday (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getWeekDay() {
        $weekday = intval($this->date->format('w'));

        if ($weekday === 0) {
            $weekday = 7;
        }

        return $weekday;
    }

    /**
     * Get the first weekday of this month (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getFirstWeekDay() {
        $firstWeekDay = intval($this->date->modify('first day of this month')->format('w'));

        if ($firstWeekDay === 0) {
            $firstWeekDay = 7;
        }

        return $firstWeekDay;
    }

    /**
     * Get the first week of this month (18th March => 9 because March starts on week 9)
     *
     * @return int
     */
    public function getFirstWeek() {
        return intval($this->date->modify('first day of this month')->format('W'));
    }

    /**
     * Get the number of days in this month
     *
     * @return int
     */
    public function getNumberOfDaysInThisMonth() {
        return intval($this->date->format('t'));
    }

    /**
     * Get the number of days in the previous month
     *
     * @return int
     */
    public function getNumberOfDaysInPreviousMonth() {
        return intval($this->date->modify('first day of previous month')->format('t'));
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
