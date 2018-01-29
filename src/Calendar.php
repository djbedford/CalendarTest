<?php namespace Calendar;

use DateTime;
use DateTimeInterface;

class Calendar implements CalendarInterface {
    const DAYS_IN_WEEK = 7;
    const WEEKS_IN_LEAP_YEAR = 53;

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
        return (int) $this->date->format('j');
    }

    /**
     * Get the week
     *
     * @return int
     */
    public function getWeek() {
        return (int) $this->date->format('W');
    }

    /**
     * Get the month
     *
     * @return int
     */
    public function getMonth() {
        return (int) $this->date->format('m');
    }

    /**
     * Get the year
     *
     * @return int
     */
    public function getYear() {
        return (int) $this->date->format('Y');
    }

    /**
     * Get the weekday (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getWeekDay() {
        $weekday = (int) $this->date->format('w');

        return ($weekday === 0) ? $weekday = 7 : $weekday;
    }

    /**
     * Get the first weekday of this month (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getFirstWeekDay() {
        $firstWeekDay = clone $this->date;
        $firstWeekDay = (int) $firstWeekDay->modify('first day of this month')->format('w');

        return ($firstWeekDay === 0) ? $firstWeekDay = 7 : $firstWeekDay;
    }

    /**
     * Get the first week of this month (18th March => 9 because March starts on week 9)
     *
     * @return int
     */
    public function getFirstWeek() {
        $firstWeek = clone $this->date;
        $firstWeek = (int) $firstWeek->modify('first day of this month')->format('W');

        return $firstWeek;
    }

    /**
     * Get the last week of this month
     *
     * @return int
     */
    public function getLastWeek() {
        $lastWeek = clone $this->date;
        $lastWeek = (int) $lastWeek->modify('last day of this month')->format('W');

        return $lastWeek;
    }

    /**
     * Get the number of days in this month
     *
     * @return int
     */
    public function getNumberOfDaysInThisMonth() {
        return (int) $this->date->format('t');
    }

    /**
     * Get the number of days in the previous month
     *
     * @return int
     */
    public function getNumberOfDaysInPreviousMonth() {
        $numberOfDaysInPreviousMonth = clone $this->date;
        $numberOfDaysInPreviousMonth = (int) $numberOfDaysInPreviousMonth
            ->modify('first day of previous month')
            ->format('t');

        return $numberOfDaysInPreviousMonth;
    }

    /**
     * Get the calendar array
     *
     * @return array
     */
    public function getCalendar() {
        $calendarMonth = [];
        $weekOfYear = $this->getFirstWeek();
        $weeksInMonth = $this->getNumberOfWeeksInThisMonth();

        for ($i = 0; $i < $weeksInMonth ; $i++) {
            $calendarMonth[$weekOfYear] = $this->buildWeek($weekOfYear);
            $weekOfYear = $this->increaseWeek($weekOfYear);
        }

        return $calendarMonth;
    }

    /**
     * Increment the week of the year
     *
     * @param $weekOfYear
     * @return int
     */
    private function increaseWeek($weekOfYear) {
        return ($weekOfYear === self::WEEKS_IN_LEAP_YEAR) ? $weekOfYear = 1 : $weekOfYear += 1;
    }

    /**
     * Build the current week
     *
     * @param $weekOfYear
     * @return array
     */
    private function buildWeek($weekOfYear) {
        $date = new DateTime;
        $week = [];
        $year = $this->getYear();

        $this->setDate($weekOfYear, $date, $year);

        for ($i = 0; $i < self::DAYS_IN_WEEK; $i++) {
            $week[$date->format('j')] = $this->shouldBeHighlighted($weekOfYear);

            $date->modify('+1 day');
        }

        return $week;
    }

    /**
     * Check if the current week should be highlighted
     *
     * @param $weekOfYear
     * @return bool
     */
    private function shouldBeHighlighted($weekOfYear) {
        $previousWeek = $this->getWeek() - 1 <= 0 ? self::WEEKS_IN_LEAP_YEAR : $this->getWeek() - 1;

        return ($previousWeek === $weekOfYear);
    }

    /**
     * Get the total number of weeks this month spans
     *
     * @return int
     */
    private function getNumberOfWeeksInThisMonth() {
        $firstWeek = $this->getFirstWeek();
        $lastWeek = $this->getLastWeek();

        return ($firstWeek === self::WEEKS_IN_LEAP_YEAR) ? $lastWeek + 1 : $lastWeek - $firstWeek + 1;
    }

    /**
     * Create new date, setting the week to begin on and factoring in leap years
     *
     * @param $weekOfYear
     * @param $date
     * @param $year
     */
    private function setDate($weekOfYear, $date, $year) {
        if ($weekOfYear === self::WEEKS_IN_LEAP_YEAR && $this->getMonth() === 1) {
            $date->setISODate(--$year, $weekOfYear);
        } else {
            $date->setISODate($year, $weekOfYear);
        }
    }
}
