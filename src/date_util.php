<?php
/**
 * DateUtil class provides calculation on two different datetime values.
 */
class DateUtil {
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
        
        if ($return_type == 'days') {
            return $difference->days;
        }
        else if ($return_type == 'y') {
            return $difference->y;
        }
        else if ($return_type == 'h') {
            return $difference->h + (24 * $difference->days);
        }
        else if ($return_type == 'i') {
            return $difference->i + (60 * ($difference->h + (24 * $difference->days)));
        }
        else if ($return_type == 's') {
            return $difference->s + (60 * ($difference->i + (60 * ($difference->h + (24 * $difference->days)))));
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
        
        if ($difference->days == 0 && $return_type == 'days') return 0;
        
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
            $begin += 86400; // +1 day
            $i++;
        }
        
        if ($return_type == 'days') {
            return $weekdays;
        }
        else if ($return_type == 'y') {
            return sprintf("%d", $weekdays/365);
        }
        else if ($return_type == 'h') {
            return $difference->h + (24 * $weekdays);
        }
        else if ($return_type == 'i') {
            return $difference->i + (60 * ($difference->h + (24 * $weekdays)));
        }
        else if ($return_type == 's') {
            return $difference->s + (60 * ($difference->i + (60 * ($difference->h + (24 * $weekdays)))));
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
        
        $weeks = $number_of_days_in_seconds / (7 * 24 * 60 * 60);
        
        return sprintf("%d", $weeks);
    }
}
?>