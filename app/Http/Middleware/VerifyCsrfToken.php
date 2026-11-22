<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestForgery as Middleware;

/**
 * Laravel 13 renamed the CSRF middleware to PreventRequestForgery (it also checks
 * Sec-Fetch-Site). The class name is kept so Kernel.php and config/sanctum.php keep working.
 */
class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
