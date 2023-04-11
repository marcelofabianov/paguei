<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::get('/', function () {
    return response()->json([
        'data' => [
            'message' => 'Welcome to the API of the administrators.',
        ],
        'status' => [
            'code' => Response::HTTP_OK,
            'message' => 'OK',
            'success' => true,
        ],
    ]);
})->name('default');
