<?php

use App\Http\Controllers\HelloController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pzn', function(){
    return "Hello Programmer Zaman Now";
});

Route::get('/hello', function(){
    return response()->view('hello', ['name' => 'Wahyu'])->setStatusCode(200);
});

Route::get('/hello-world', function(){
    return response()->view('hello.world', ['name' => 'Wahyu'])->setStatusCode(200);
});

Route::redirect('/youtube', '/pzn', 301);

// error page
Route::fallback(function () {
    return response("404 By Wahyu", 404);
});

Route::get('/products/{id}', function ($productId) {
    return "Product ID: " . $productId;
})->name('product.detail');

Route::get('/products/{id}/items/{item}', function($productId, $itemId){
    return "Product ID: " . $productId . " Item ID: " . $itemId;
})->name('product.item.detail');

Route::get('/categories/{id}', function($categoryId){
    return "Category ID: " . $categoryId;
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function(string $userId = '404'){
    return "User ID: " . $userId;
})->where('id', '[0-9]+')->name('user.detail');

Route::get('/produk/{id}', function($productId){
    $link = route('product.detail', ['id' => $productId]);
    return "Link : " . $link;
});

Route::get('/produk-redirect/{id}', function($productId){
    return redirect()->route('product.detail', ['id' => $productId]);
});

Route::get('/controller/hello/{name}', [HelloController::class, 'hello']);