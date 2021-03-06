<?php

namespace App\Http\Middleware;

use Themosis\Core\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/v1/login/auth',
        'api/v1/login/create-users-from-wp'
    ];
}
