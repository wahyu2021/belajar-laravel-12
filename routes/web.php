<?php

use App\Http\Controllers\CookieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ResponseController;

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

Route::get('/controller/hello/request', [HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [HelloController::class, 'hello']);

Route::get('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello/first', [InputController::class, 'helloFirstName']);
Route::post('/input/hello/input', [InputController::class, 'helloInput']);
Route::post('/input/hello/array', [InputController::class, 'arrayInput']);
Route::post('/input/type', [InputController::class, 'inputType']);
Route::post('/input/filter/only', [InputController::class, 'inputOnly']);
Route::post('/input/filter/except', [InputController::class, 'inputExcept']);
Route::post('/input/filter/merge', [InputController::class, 'filterMerge']);
Route::post('/input/filter/merge-if-missing', [InputController::class, 'filterMergeIfMissing']);

Route::post('/file/upload', [FileController::class, 'upload']);

Route::get('/response/hello', [ResponseController::class, 'response']);
Route::get('/response/header', [ResponseController::class, 'header']);
Route::get('/response/type/view', [ResponseController::class, 'reponseView']);
Route::get('/response/type/json', [ResponseController::class, 'responseJson']);
Route::get('/response/type/download', [ResponseController::class, 'responseDownloadFile']);
Route::get('/response/type/file', [ResponseController::class, 'responseFile']);

Route::get('/cookie/set', [CookieController::class, 'createCookie']);