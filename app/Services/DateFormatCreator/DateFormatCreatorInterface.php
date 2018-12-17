<?php

namespace App\Services\DateFormatCreator;

/**
 * Description of DateFormatCreatorInterface
 *
 * @author marcintalik
 */
interface DateFormatCreatorInterface {

    /**
     * Create from string to dateTime format
     * @param string $date
     * @return dateTime 
     */
    public function changeToDateFormat($date);

    /**
     * Add days to datetime format
     * @param string $date
     * @param int $numberOfDays
     * @return dateTime 
     */
    public function addDays($date, $numberOfDays);
}
