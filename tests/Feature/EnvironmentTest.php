<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGetEnv(): void
    {
        $env = Env::get('YOUTUBE');

        self::assertEquals('Programmer Zaman Now', $env);
    }

    public function testDefaultEnv(): void
    {
        $env = env('AUTHOR', 'Eko');

        self::assertEquals('Eko', $env);
    }
}
