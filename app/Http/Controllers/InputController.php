<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        $name = $request->input('name', 'Guest');
        return "Hello, " . $name;
    }

    public function helloFirstName(Request $request): string
    {
        $firstName = $request->input('name.first', 'Guest');
        $lastName = $request->input('name.last', 'Guest');
        return "Hello, " . $firstName . " " . $lastName;
    }

    public function helloInput(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }

    public function arrayInput(Request $request): string
    {
        $name = $request->input('products.*.name');
        return json_encode($name);
    }

    public function inputType(Request $request): string
    {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $birthDate = $request->date('birth_date', 'Y-m-d');
        return json_encode([
            'name' => $name,
            'married' => $married,
            'birth_date' => $birthDate->format('Y-m-d')
        ]);
    }

    public function inputOnly(Request $request): string
    {
        $name = $request->only(['name.first', 'name.last']);
        return json_encode($name);
    }
    
    public function inputExcept(Request $request): string
    {
        $user = $request->except("admin");
        return json_encode($user);
    }

    public function filterMerge(Request $request): string
    {
        $request->merge(['admin' => false]);
        $user = $request->input();
        return json_encode($user);
    }

    public function filterMergeIfMissing(Request $request): string
    {
        $request->mergeIfMissing(['admin' => false]);
        $user = $request->input();
        return json_encode($user);
    }
}
