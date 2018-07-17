<?php
/**
 * DateUtil class provides calculation on two different datetime values.
 */
class DateUtil {
    
    const DAYS_PER_WEEK = 7;
    const HOURS_PER_DAY = 24;
    const MINS_PER_HOUR = 60;
    const SECS_PER_MIN = 60;
    const WORKING_DAYS_AS_A_YEAR = 365; // 365 working days (not calendar days) equals to 1 working year
    const Y = 'y';
    const DAYS = 'days';
    const H = 'h';
    const I = 'i';
    const S = 's';
    
    /**
     * This function calculates the number of days or years or hours or minutes or seconds between two given datetime.
     * 
     * @param DateTime $datetime1
     * @param DateTime $datetime2
     * @param string $return_type
     * @return int
     */
    function number_of_days($datetime1, $datetime2, $return_type) {
        $difference = $datetime1->diff($datetime2);
        
        if ($return_type == self::DAYS) {
            return $difference->days;
        }
        else if ($return_type == self::Y) {
            return $difference->y;
        }
        else if ($return_type == self::H) {
            return $difference->h + (self::HOURS_PER_DAY * $difference->days);
        }
        else if ($return_type == self::I) {
            return $difference->i + (self::MINS_PER_HOUR * ($difference->h + (self::HOURS_PER_DAY * $difference->days)));
        }
        else if ($return_type == self::S) {
            return $difference->s + (self::SECS_PER_MIN * ($difference->i + (self::MINS_PER_HOUR * ($difference->h + (self::HOURS_PER_DAY * $difference->days)))));
        }
    }
    
    /**
     * This function calculates the number of week days (working days) or years or hours or minutes or seconds between two given datetime.
     *
     * @param DateTime $datetime1
     * @param DateTime $datetime2
     * @param string $return_type
     * @return int
     */
    function number_of_weekdays($datetime1, $datetime2, $return_type) {
        $difference = $datetime1->diff($datetime2);
        
        if ($difference->days == 0 && $return_type == self::DAYS) return 0;
        
        $begin = $datetime1->getTimestamp();
        $end = $datetime2->getTimestamp();
        if ($difference->invert == 1) {
            $begin = $datetime2->getTimestamp();
            $end = $datetime1->getTimestamp();
        }
        $i = 1;
        $weekdays = 0;
        while ($begin < $end && $i<=$difference->days) {
            $what_day = date("N", $begin);
            
            if ($what_day < 6) { // 6 and 7 are weekend
                $weekdays++;
            }
            $begin += self::HOURS_PER_DAY * self::MINS_PER_HOUR * self::SECS_PER_MIN; // +1 day
            $i++;
        }
        
        if ($return_type == self::DAYS) {
            return $weekdays;
        }
        else if ($return_type == self::Y) {
            return sprintf("%d", $weekdays/self::WORKING_DAYS_AS_A_YEAR);
        }
        else if ($return_type == self::H) {
            return $difference->h + (self::HOURS_PER_DAY * $weekdays);
        }
        else if ($return_type == self::I) {
            return $difference->i + (self::MINS_PER_HOUR * ($difference->h + (self::HOURS_PER_DAY * $weekdays)));
        }
        else if ($return_type == self::S) {
            return $difference->s + (self::SECS_PER_MIN * ($difference->i + (self::MINS_PER_HOUR * ($difference->h + (self::HOURS_PER_DAY * $weekdays)))));
        }
    }
    
    /**
     * This function calculates the number of complete weeks between two given datetime.
     *
     * @param DateTime $datetime1
     * @param DateTime $datetime2
     * @param string $return_type is added for consistency only.
     * @return int
     */
    function number_of_complete_weeks($datetime1, $datetime2, $return_type) {
        $number_of_days_in_seconds = $this->number_of_days($datetime1, $datetime2, 's');
        
        $weeks = $number_of_days_in_seconds / (self::DAYS_PER_WEEK * self::HOURS_PER_DAY * self::MINS_PER_HOUR * self::SECS_PER_MIN);
        
        return sprintf("%d", $weeks);
    }
}
?>