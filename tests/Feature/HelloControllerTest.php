<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function testHello()
    // {
    //     $this->get('/controller/hello')
    //         ->assertSeeText('Hello World');
    // }

    public function testHelloWithName()
    {
        $this->get('/controller/hello/Wahyu')
            ->assertSeeText('Halo Wahyu');
    }
}
