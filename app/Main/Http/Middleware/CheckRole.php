<?php

declare(strict_types=1);

namespace App\Main\Http\Middleware;

use App\Main\Http\Controllers\DefaultJsonResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    use DefaultJsonResponseTrait;

    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($request->user()->role->value !== $role) {
            return $this->forbidden();
        }

        return $next($request);
    }
}
