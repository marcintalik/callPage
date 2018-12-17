<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Employee;

class EmployeeTest extends TestCase {

    use RefreshDatabase;

    public function testEmployees() {

        $response = $this->get('/employees');

        $response->assertStatus(200);
    }

    public function testEmployeesCreate() {

        $response = $this->get('/employees/create');


        $response->assertStatus(200);
    }

    public function testEmployeesStore() {

        $response = $this->json('POST', '/employees', [
            'employee_name' => 'John Doe'
        ]);
        ;

        $response->assertStatus(302);
    }

    public function testEmployeesUpdate() {
        factory(Employee::class, 1)->create();

        $response = $this->json('PUT', '/employees/1', [
            'employee_name' => 'John Doe'
        ]);
        ;

        $response->assertStatus(302);
    }

    public function testEmployeesEdit() {

        factory(Employee::class, 1)->create();

        $response = $this->call('GET', '/employees/1/edit');

        $response->assertStatus(200);
    }

    public function testEmployeesDestroy() {

        factory(Employee::class, 1)->create();

        $response = $this->call('DELETE', '/employees/1');

        $response->assertStatus(302);
    }

}
