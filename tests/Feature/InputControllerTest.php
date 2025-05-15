<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testInput()
    {
        $this->get('/input/hello?name=Wahyu')->assertSeeText('Hello, Wahyu');
        $this->post('/input/hello', [
            'name' => 'Wahyu'
        ])->assertSeeText('Hello, Wahyu');
        $this->get('/input/hello')->assertSeeText('Hello, Guest');
        $this->post('/input/hello')->assertSeeText('Hello, Guest');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first',[
            'name' => [
                'first' => 'Wahyu',
                'last' => 'Hidayat'
            ]
        ])->assertSeeText('Hello, Wahyu Hidayat');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input',[
            'name' => [
                'first' => 'Wahyu',
                'last' => 'Hidayat'
            ]
        ])->assertSeeText('name')->assertSeeText('first')
            ->assertSeeText('last')->assertSeeText('Wahyu')->assertSeeText('Hidayat');
    }

    public function testArrayInput()
    {
        $this->post('/input/hello/array', [
            'products' => [
                [
                    'name' => 'Apple Macbook Pro 16',
                    'price' => 1000
                ],
                [
                    'name' => 'Samsung Galaxy S23',
                    'price' => 2000
                ],
                [
                    'name' => 'Iphone 14 Pro Max',
                    'price' => 2000
                ],
                [
                    'name' => 'Xiaomi 13 Pro',
                    'price' => 2000
                ],
                [
                    'name' => 'Acer Predator Helios 16',
                    'price' => 2000
                ]
            ]
        ])->assertSeeText('Apple Macbook Pro 16')
            ->assertSeeText('Samsung Galaxy S23')
            ->assertSeeText('Iphone 14 Pro Max');
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Wahyu',
            'married' => 'false',
            'birth_date' => '2023-10-01'
        ])->assertSeeText('Wahyu')
            ->assertSeeText('false')
            ->assertSeeText('2023-10-01');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            'name' => [
                'first' => 'Wahyu',
                'last' => 'Hidayat'
            ],
            'age' => 20,
            'address' => 'Jakarta'
        ])->assertSeeText('Wahyu')
            ->assertSeeText('Hidayat')
            ->assertDontSeeText('20')
            ->assertDontSeeText('Jakarta');
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            'name' => [
                'first' => 'Wahyu',
                'last' => 'Hidayat'
            ],
            'admin' => "true",
            'age' => 20,
            'address' => 'Jakarta'
        ])->assertSeeText('Wahyu')
            ->assertSeeText('Hidayat')
            ->assertSeeText('20')
            ->assertSeeText('Jakarta')
            ->assertDontSeeText('admin');
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            'name' => [
                'first' => 'Wahyu',
                'last' => 'Hidayat'
            ],
            'admin' => "true",
            'age' => 20,
            'address' => 'Jakarta'
        ])->assertSeeText('Wahyu')
            ->assertSeeText('Hidayat')
            ->assertSeeText('20')
            ->assertSeeText('Jakarta')
            ->assertSeeText('false');
    }
}
