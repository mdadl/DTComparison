<?php
use PHPUnit\Framework\TestCase;

require('../src/date_util.php');

class DateUtilTest extends TestCase {
    private $date_util;
    
    protected function setUp() {
        $this->date_util = new DateUtil();
        date_default_timezone_set("UTC");
    }
    
    public function testnumber_of_days() {
        // A whole calendar month
        $this->assertEquals(31, $this->date_util->number_of_days(
            new DateTime("2018-07-01 00:00:00"), new DateTime("2018-08-01 00:00:00"), "days"));
        // A whole calendar month minus one second
        $this->assertEquals(30, $this->date_util->number_of_days(
            new DateTime("2018-07-01 00:00:00"), new DateTime("2018-07-31 23:59:59"), "days"));
        // A whole inverted calendar month
        $this->assertEquals(31, $this->date_util->number_of_days(
            new DateTime("2018-08-01 00:00:00"), new DateTime("2018-07-01 00:00:00"), "days"));
        // A whole calendar year
        $this->assertEquals(365, $this->date_util->number_of_days(
            new DateTime("2018-01-01 00:00:00"), new DateTime("2019-01-01 00:00:00"), "days"));
        // A whole calendar leap year
        $this->assertEquals(366, $this->date_util->number_of_days(
            new DateTime("2012-01-01 00:00:00"), new DateTime("2013-01-01 00:00:00"), "days"));
    }
    
    public function testnumber_of_days_in_hours() {
        // A whole calendar month
        $this->assertEquals(31*24, $this->date_util->number_of_days(
            new DateTime("2018-07-01 00:00:00"), new DateTime("2018-08-01 00:00:00"), "h"));
        // A whole calendar month minus one second
        $this->assertEquals((30*24)+23, $this->date_util->number_of_days(
            new DateTime("2018-07-01 00:00:00"), new DateTime("2018-07-31 23:59:59"), "h"));
        // A whole inverted calendar month
        $this->assertEquals(31*24, $this->date_util->number_of_days(
            new DateTime("2018-08-01 00:00:00"), new DateTime("2018-07-01 00:00:00"), "h"));
        // A whole calendar year
        $this->assertEquals(365*24, $this->date_util->number_of_days(
            new DateTime("2018-01-01 00:00:00"), new DateTime("2019-01-01 00:00:00"), "h"));
        // A whole calendar leap year
        $this->assertEquals(366*24, $this->date_util->number_of_days(
            new DateTime("2012-01-01 00:00:00"), new DateTime("2013-01-01 00:00:00"), "h"));
        // Daylight savings in Adelaide 
        date_default_timezone_set("Australia/Adelaide");
        $this->assertEquals(5, $this->date_util->number_of_days(
            new DateTime("2018-04-01 00:00:00"), new DateTime("2018-04-01 04:00:00"), "h"));
        date_default_timezone_set("UTC");
    }
    
    public function testnumber_of_weekdays() {
        // A whole calendar month
        $this->assertEquals(22, $this->date_util->number_of_weekdays(
            new DateTime("2018-07-01 00:00:00"), new DateTime("2018-08-01 00:00:00"), "days"));
        // A whole calendar month minus one second
        $this->assertEquals(21, $this->date_util->number_of_weekdays(
            new DateTime("2018-07-01 00:00:00"), new DateTime("2018-07-31 23:59:59"), "days"));
        // A whole inverted calendar month
        $this->assertEquals(22, $this->date_util->number_of_weekdays(
            new DateTime("2018-08-01 00:00:00"), new DateTime("2018-07-01 00:00:00"), "days"));
    }
    
    public function testnumber_of_weekdays_in_hours() {
        // A whole calendar month
        $this->assertEquals(22*24, $this->date_util->number_of_weekdays(
            new DateTime("2018-07-01 00:00:00"), new DateTime("2018-08-01 00:00:00"), "h"));
        // A whole calendar month minus one second
        $this->assertEquals((21*24)+23, $this->date_util->number_of_weekdays(
            new DateTime("2018-07-01 00:00:00"), new DateTime("2018-07-31 23:59:59"), "h"));
        // A whole inverted calendar month
        $this->assertEquals(22*24, $this->date_util->number_of_weekdays(
            new DateTime("2018-08-01 00:00:00"), new DateTime("2018-07-01 00:00:00"), "h"));
    }
    
    public function testnumber_of_complete_weeks() {
        // A whole calendar month
        $this->assertEquals(4, $this->date_util->number_of_complete_weeks(
            new DateTime("2018-07-01 00:00:00"), new DateTime("2018-08-01 00:00:00"), null));
        // A whole calendar year
        $this->assertEquals(52, $this->date_util->number_of_complete_weeks(
            new DateTime("2018-01-01 00:00:00"), new DateTime("2019-01-01 00:00:00"), null));
    }
}
?>