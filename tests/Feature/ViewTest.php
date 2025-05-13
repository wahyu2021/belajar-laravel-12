<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'Wahyu'])
            ->assertSeeText('Hello Wahyu');

        $this->view('hello.world', ['name' => 'Wahyu'])
            ->assertSeeText('World Wahyu');
    }
}
