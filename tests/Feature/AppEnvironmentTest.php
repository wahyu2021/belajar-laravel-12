<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AppEnvironmentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testAppEnv(): void
    {
        if (App::environment('testing')) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false, 'The application is not running in the local environment.');
        }
    }
}
