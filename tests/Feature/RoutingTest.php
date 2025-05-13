<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText('Hello Programmer Zaman Now');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertStatus(301)
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/not-found')
            ->assertStatus(404)
            ->assertSeeText('404 By Wahyu');
    }

    public function testView()
    {
        $this->get('/hello')
            ->assertStatus(200)
            ->assertSeeText('Hello Wahyu');

        $this->get('/hello-world')
            ->assertStatus(200)
            ->assertSeeText('World Wahyu');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product ID: 1');

        $this->get('/products/1/items/2')
            ->assertSeeText('Product ID: 1 Item ID: 2');

        $this->get('/categories/1')
            ->assertSeeText('Category ID: 1');

        // $this->get('/categories/dsda')
        //     ->assertSeeText('Category ID: dsda');
    }

    public function testOptionalRouteParameter()
    {
        $this->get('/users')
            ->assertSeeText('User ID: 404');

        $this->get('/users/1')
            ->assertSeeText('User ID: 1');
    }

    public function testNamedRoute()
    {
        $this->get('/produk/1')
            ->assertSeeText('Link : http://localhost/products/1');
        
        $this->get('/produk-redirect/1')
            ->assertRedirect('/products/1');
        
    }

}
