<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/prac01',
        '/prac02',
        '/prac03',
        '/standby',
        '/ques01',
        '/ques02',
        '/auto_mail'
    ];
}
