<?php

namespace App\Consumers\Administrators\Http\Controllers;

use App\Main\Http\Controllers\ApiController;

final class DefaultController extends ApiController
{
    public function index(): string
    {
        return 'Hello Administrator!';
    }
}
