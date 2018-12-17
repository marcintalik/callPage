<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Employee;
use App\Models\Shift;

class DateFormatCreatorTest extends TestCase {

    use RefreshDatabase;

    private $year = '2018';
    private $month = '12';
    private $days = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10'];
    private $hours = [['08:00:00', '12:00:00'], ['14:00:00', '16:00:00'], ['16:00:00', '18:00:00'], ['06:30:00', '07:30:00'], ['03:00:00', '07:00:00']];

    /**
     * Test proper work of algorithm and compare special pack of data in database with model output
     *  @return void
     */
    public function testSlotsSortAlgorithm() {
        $this->generateDummyData();
        $dates = $this->getDatesFromData();
        $model = $this->getModelOfData($dates);
        $response = $this->post('/shifts/search', [
            'number_of_days' => count($this->days),
            'shift_date' => $this->days[0] . '/' . $this->month . '/' . $this->year
                ])
        ;
        $d = $response->getOriginalContent()->getData();
        $data = $d['data'][0];
        $this->assertTrue($this->compareDataWithModel($model, $data));
    }

    /**
     * Compare data with model
     *  @return bolean
     */
    private function compareDataWithModel($model, $data) {

        return $model == $data;
    }

    /**
     * Prepare full date from parameters
     *  @return array
     */
    private function getDatesFromData() {
        $dates = [];
        foreach ($this->days as $day) {
            $date = $shift_start = '' . $day . '.' . $this->month . '.' . $this->year;
            $dates[] = $date;
        }
        return $dates;
    }

    /**
     * Prepare model of proper data output
     *  @return json string
     */
    private function getModelOfData($dates) {
        $model = '[';
        $comma = ',';
        foreach ($dates as $key => $d) {
            if ($key + 1 == count($dates)) {
                $comma = ']';
            }
            $model .= '{"data":"' . $d . '",'
                    . '"slots":[["03:00","07:30"],'
                    . '["08:00","12:00"],'
                    . '["14:00","18:00"]]}' . $comma;
        }

        return $model;
    }

    /**
     * Generate dummy data pack and save it in database
     *  @return void
     */
    private function generateDummyData() {
        $i = 1;
        $year = '2018';
        $month = '12';
        $days = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10'];
        $hours = [['08:00:00', '12:00:00'], ['14:00:00', '16:00:00'], ['16:00:00', '18:00:00'], ['06:30:00', '07:30:00'], ['03:00:00', '07:00:00']];
        factory(Employee::class, 100)->create();
        foreach ($this->days as $day) {
            foreach ($this->hours as $hour) {
                $shift_start = '' . $this->year . '-' . $this->month . '-' . $day . ' ' . $hour[0] . '';
                $shift_end = '' . $this->year . '-' . $this->month . '-' . $day . ' ' . $hour[1] . '';
                $shift = new Shift([
                    'shift_start' => $shift_start,
                    'shift_end' => $shift_end,
                    'employee_id' => $i
                ]);

                $shift->save();
                $i++;
            }
        }
    }

}
