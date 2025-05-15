<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testEncrypt()
    {
        $name = 'Eko Kurniawan';
        $encrypted = Crypt::encrypt($name);
        var_dump($encrypted);

        $decrypted = Crypt::decrypt($encrypted);
        
        self::assertEquals($name, $decrypted);
    }
}
