<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testURLCurrent()
    {
        $this->get('/url/current')
            ->assertSeeText('/url/current');
    }

    public function testURLFull()
    {
        $this->get('/url/full?name=wahyu')
            ->assertSeeText('/url/full?name=wahyu');
    }

    public function testNamed()
    {
        $this->get('/redirect/named')
            ->assertSeeText('/redirect/name/Wahyu');
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText('/redirect/name/Wahyu');
    }
}
