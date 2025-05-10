<?php

namespace App\Data;

class Person
{
    public function __construct(
        public string $firstName,
        public string $lastName,
    ) {
        // $this->firstName = $firstName;
        // $this->lastName = $lastName;
    }
}