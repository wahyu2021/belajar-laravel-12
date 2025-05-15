<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertSeeText('hello response')
            ->assertStatus(200);
    }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertSeeText('Eko')
            ->assertSeeText('Kurniawan')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'Programmer Zaman Now')
            ->assertHeader('App', 'Belajar Laravel')
            ->assertHeader('Version', '1.0.0');
    }

    public function testResponseView()
    {
        $this->get('/response/type/view')
            ->assertSeeText('Hello Wahyu')
            ->assertStatus(200);
    }

    public function testResponseJson()
    {
        $this->get('/response/type/json')
            ->assertJson(
                [
                    'firstName' => 'Eko',
                    'lastName' => 'Kurniawan'
                ]
            );
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/jpg');
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('wp.jpg');
    }
}
