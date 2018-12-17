<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Shift;
use App\Models\Employee;

class ShiftTest extends TestCase
{
    use RefreshDatabase;
    public function testShifts() {

        $response = $this->get('/shifts');

        $response->assertStatus(200);
    }

    public function testShiftsCreate() {

        $response = $this->get('/shifts/create');

        if (DB::table('employees')->get()->isEmpty()) {
            $response->assertStatus(302);
        } else {
            $response->assertStatus(200);
        }
    }

    public function testShiftsSearch() {

        $response = $this->json('POST', '/shifts/search', [
            'number_of_days' => 10,
            'shift_date' => '10/10/2018'
        ]);
        ;

        $response->assertStatus(200);
    }

    public function testShiftsStore() {

        factory(Employee::class, 1)->create();

        $response = $this->json('POST', '/shifts', [
            'shift_owner' => 1,
            'shift_date' => '10/10/2018',
            'shift_start' => '10:10',
            'shift_end' => '11:10',
        ]);
        ;

        $response->assertStatus(302);
    }

    public function testShiftsUpdate() {

        factory(Employee::class, 1)->create();
        factory(Shift::class, 1)->create();

        $response = $this->json('PUT', '/shifts/1', [
            'shift_owner' => 1,
            'shift_date' => '10/10/2018',
            'shift_start' => '11:10',
            'shift_end' => '12:10',
        ]);
        ;

        $response->assertStatus(302);
    }

    public function testShiftsEdit() {

        factory(Shift::class, 1)->create();

        $response = $this->call('GET', '/shifts/1/edit');

        $response->assertStatus(200);
    }

    public function testShiftsDestroy() {

        factory(Shift::class, 1)->create();

        $response = $this->call('DELETE', '/shifts/1');

        $response->assertStatus(302);
    }
}
