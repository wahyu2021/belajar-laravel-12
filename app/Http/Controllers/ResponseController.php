<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        return response("hello response");
    }

    public function header(Request $request): Response
    {
        $body = [
            'firstName' => 'Eko',
            'lastName' => 'Kurniawan',
        ];
        return response(json_encode($body), 200)
            ->header('Content-Type', 'application/json')
            ->withHeaders([
                'Author' => 'Programmer Zaman Now',
                'App' => 'Belajar Laravel',
                'Version' => '1.0.0',
            ]);
    }

    public function reponseView(Request $request): Response
    {
        return response()->view('hello', ['name' => 'Wahyu']);
    }

    public function responseJson(Request $request): JsonResponse
    {
        $body = [
            'firstName' => 'Eko',
            'lastName' => "Kurniawan"
        ];
        return response()->json($body)->header('Content-Type', 'application/json');
    }

    public function responseDownloadFile(Request $request): BinaryFileResponse
    {   
        $filePath = public_path('storage/pictures/9935.jpg');
        return response()->download($filePath, 'wp.jpg', ['Content-Type' => 'image/jpg']);
    }

    public function responseFile(Request $request): BinaryFileResponse
    {
        $filePath = public_path('storage/pictures/9935.jpg');
        return response()->file($filePath, ['Content-Type' => 'image/jpg']);
    }
}
