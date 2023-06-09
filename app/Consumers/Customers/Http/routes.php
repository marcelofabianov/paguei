<?php

declare(strict_types=1);

use App\Consumers\Customers\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::get('/', function () {
    return response()->json([
        'data' => [
            'message' => 'Welcome to the API.',
        ],
        'status' => [
            'code' => Response::HTTP_OK,
            'message' => 'OK',
            'success' => true,
        ],
    ]);
})->name('default');

Route::apiResource('categories', CategoriesController::class);
