<?php

namespace App\Services\ShiftSorter;

/**
 * Description of DateFormatCreatorInterface
 *
 * @author marcintalik
 */
interface ShiftSorterInterface {

    /**
     * Prepare a slots of data by algorithm.
     * @param array $shifts
     * @return array
     */
    public function sort($shifts);

    /**
     * Transform slot of time to expected form.
     * @param array $slot
     * @return array
     */
    public function transformSlotFormat($slot);

    /**
     * Transform shift date to expected form.
     * @param string $slot
     */
    public function transformShiftFormat($shift);
}
