<?php

use App\Exceptions\ValidationException;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\URL;

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

Route::prefix('/input')->group(function(){
    Route::get('/hello', [InputController::class, 'hello']);
    Route::post('/hello', [InputController::class, 'hello']);
    Route::post('/hello/first', [InputController::class, 'helloFirstName']);
    Route::post('/hello/input', [InputController::class, 'helloInput']);
    Route::post('/hello/array', [InputController::class, 'arrayInput']);
    Route::post('/type', [InputController::class, 'inputType']);
    Route::post('/filter/only', [InputController::class, 'inputOnly']);
    Route::post('/filter/except', [InputController::class, 'inputExcept']);
    Route::post('/filter/merge', [InputController::class, 'filterMerge']);
    Route::post('/filter/merge-if-missing', [InputController::class, 'filterMergeIfMissing']);
});

Route::post('/file/upload', [FileController::class, 'upload'])->withoutMiddleware([VerifyCsrfToken::class]);

Route::get('/response/hello', [ResponseController::class, 'response']);
Route::get('/response/header', [ResponseController::class, 'header']);

Route::prefix('/response/type')->group(function(){
    Route::get('/view', [ResponseController::class, 'reponseView']);
    Route::get('/json', [ResponseController::class, 'responseJson']);
    Route::get('/download', [ResponseController::class, 'responseDownloadFile']);
    Route::get('/file', [ResponseController::class, 'responseFile']);
});

Route::prefix('/cookie')->group(function(){
    Route::get('/set', [CookieController::class, 'createCookie']);
    Route::get('/get', [CookieController::class, 'getCookie']);
    Route::get('/clear', [CookieController::class, 'clearCookie']);
});

Route::prefix('/redirect')->controller(RedirectController::class)->group(function(){
    Route::get('/from', 'redirectFrom');
    Route::get('/to', 'redirectTo');
    Route::get('/name', 'redirectName');
    Route::get('/name/{name}', 'redirectHello')
        ->name('redirect-hello');
    Route::get('/action', 'redirectAction');
    Route::get('/away', 'redirectAway');
});

Route::middleware('contoh:PZN,401')->prefix('/middleware')->group(function(){
    Route::get('/hello', function(){
        return "Hello Middleware";
    });
    Route::get('/api', function(){
        return "Ok";
    });
    Route::get('/group', function(){
        return "GROUP";
    });
});



Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'submitForm']);

Route::get('/url/current', function(){
    // Tanpa facades
    // return url()->current();
    // pakai facades
    return URL::current();
});

Route::get('/url/full', function(){
    // Tanpa facades
    // return url()->full();
    // pakai facades
    return URL::full();
});

Route::get('/redirect/named', function(){
    // return route('redirect-hello', ['name' => 'Wahyu']);
    // return URL::route('redirect-hello', ['name' => 'Wahyu']);
    return url()->route('redirect-hello', ['name' => 'Wahyu']);
});

Route::get('/url/action', function(){
    // return action([RedirectController::class, 'redirectHello'], ['name' => 'Wahyu']);
    // return URL::action([RedirectController::class, 'redirectHello'], ['name' => 'Wahyu']);
    return url()->action([RedirectController::class, 'redirectHello'], ['name' => 'Wahyu']);
});

Route::get('/session/create', [SessionController::class, 'createSession']);
Route::get('/session/get', [SessionController::class, 'getSession']);

Route::get('/error/sample', function (){
    throw new Exception('Sample Error');
});
Route::get('/error/manual', function (){
    report(new Exception("Sample Error"));
    return "OK";
});
Route::get('/error/validation', function(){
    throw new ValidationException("Validation Error");
});

Route::prefix('/abort')->group(function(){
    Route::get('/400', function(){
        abort(400, "Ups Validation Error");
    });
    Route::get('/401', function(){
        abort(401);
    });
    Route::get('/500', function(){
        abort(500);
    });
});