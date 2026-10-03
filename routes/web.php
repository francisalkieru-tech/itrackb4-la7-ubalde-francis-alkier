<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/whoami', function () {
    return 'Francis Alkier M. Ubalde | 2023-70377 | Block 4c | ITRACKB4 Laravel 12';
});

Route::get('/products/featured', function(){
    return redirect()->route('products.show', 5);
}) -> name('products.featured');

Route::get('/products/filter/{category?}', function ($category = null) {
    return redirect()->route('products.index', $category ? ['category' => $category] : []);
});

Route::resource('products', ProductController::class) -> only('index', 'show', 'create', 'store');


