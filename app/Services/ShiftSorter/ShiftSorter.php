<?php

namespace App\Services\ShiftSorter;

/**
 * Description of DateFormatCreator - this class contains algorithm that checkig a slots of employees work time.                                
 *
 * @author marcintalik
 */
class ShiftSorter implements ShiftSorterInterface {

    private $fData;                       

    public function __construct($fData) {
        $this->fData = $fData;
    }

    /**
     * Prepare a slots of data by algorithm.
     * @param array $shifts
     * @return array
     */
    public function sort($shifts) {
        foreach ($shifts as $shift) {
            $this->transformShiftFormat($shift);
        }
        $daysSlotsList = [];
        foreach ($this->fData as $key => $day) {
            $daySlotList = [];
            $actualSlot = $day[0];
            for ($i = 1; $i < count($day); $i++) {
                $nextSlot = $day[$i];
                if ($nextSlot[1] > $actualSlot[1] && $nextSlot[0] <= $actualSlot[1]) {
                    $actualSlot = [$actualSlot[0], $nextSlot[1]];
                } elseif ($nextSlot[1] > $actualSlot[1] && $nextSlot[0] > $actualSlot[1]) {
                    $daySlotList[] = $this->transformSlotFormat($actualSlot);
                    $actualSlot = $nextSlot;
                }
            }
            $daySlotList[] = $this->transformSlotFormat($actualSlot);
            $daysSlotsList[] = ['data' => $key, 'slots' => $daySlotList];
        }
        return json_encode($daysSlotsList);
    }

    /**
     * Transform slot of time to expected form.
     * @param array $slot
     * @return array
     */
    public function transformSlotFormat($slot) {
        $a = [];
        foreach ($slot as $s) {
            $H = substr($s, 11, 5);
            $a[] = $H;
        }
        return $a;
    }

    /**
     * Transform shift date to expected form.
     * @param string $slot
     */
    public function transformShiftFormat($shift) {
        $dayS = str_replace('-', '', substr($shift->shift_start, 0, 10));
        $dayF = substr($dayS, 6, 2) . '.' . substr($dayS, 4, 2) . '.' . substr($dayS, 0, 4);
        $this->fData[$dayF][] = [$shift->shift_start, $shift->shift_end];
    }

}
