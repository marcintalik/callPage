<?php

namespace Tests\Feature;

use Tests\TestCase;


class BasicTest extends TestCase {

    public function testHome() {

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    

}
