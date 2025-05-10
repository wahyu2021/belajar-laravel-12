<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $fisrtName = config("contoh.author.first");
        $lastName = config("contoh.author.last");
        $email = config("contoh.email");
        $web = config("contoh.web");

        self::assertEquals("Eko", $fisrtName);
        self::assertEquals("Khannedy", $lastName);
        self::assertEquals("echo.khannedy@gmail.com", $email);
        self::assertEquals("https://www.youtube.com/ProgrammerZamanNow", $web);
    }
}
