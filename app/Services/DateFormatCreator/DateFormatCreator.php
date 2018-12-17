<?php

namespace App\Services\DateFormatCreator;

/**
 * Class for changing data format and fo operation on DateTime format
 *
 * @author marcintalik
 */
class DateFormatCreator implements DateFormatCreatorInterface {

    /**
     * Create from string to dateTime format
     * @param string $date
     * @return dateTime 
     */
    public function changeToDateFormat($date) {
        return \DateTime::createFromFormat('d/m/Y:H:i', $date);
    }

    /**
     * Add days to datetime format
     * @param string $date
     * @param int $numberOfDays
     * @return dateTime 
     */
    public function addDays($date, $numberOfDays) {
        return $date->add(new \DateInterval('P' . $numberOfDays . 'D'));
    }

}
