<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testStorage(): void
    {   
        $filesystem = Storage::disk('local');
        $filesystem->put('file.txt', 'Hello World');

        self::assertTrue($filesystem->exists('file.txt'));
        self::assertEquals('Hello World', $filesystem->get('file.txt'));
    }

    public function testPublic(): void
    {   
        $filesystem = Storage::disk('public');
        $filesystem->put('file.txt', 'Hello World');
        
        self::assertTrue($filesystem->exists('file.txt'));
        self::assertEquals('Hello World', $filesystem->get('file.txt'));
    }
    
    
}
