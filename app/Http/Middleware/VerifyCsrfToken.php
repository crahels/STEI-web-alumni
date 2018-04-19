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
    ];

    protected function tokensMatch($request) {
        $token = $request->ajax() ? $request->header('X-CSRF-TOKEN') : $request->input('_token');
        return $request->session()->token() == $token;
    }
}
