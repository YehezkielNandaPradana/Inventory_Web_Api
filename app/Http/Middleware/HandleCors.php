<?php

namespace App\Http\Middleware;

use Closure;
use Fruitcake\Cors\CorsService;
use Illuminate\Http\Request;

class HandleCors
{
    public function __construct(private CorsService $cors) {}

    public function handle(Request $request, Closure $next)
    {
        $this->cors->addPreflightHeaders();

        $response = $next($request);

        $this->cors->setResponse($response);

        $this->cors->varyHeader($response, 'Origin');

        return $response->withHeaders($this->cors->getResponseHeaders());
    }
}
