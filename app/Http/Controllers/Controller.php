<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

// Placeholder for isAdmin middleware
// To be placed in app/Http/Middleware/IsAdmin.php
//
// namespace App\Http\Middleware;
//
// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
//
// class IsAdmin
// {
//     public function handle(Request $request, Closure $next): Response
//     {
//         if (!auth()->check() || !auth()->user()->isAdmin()) {
//             abort(403, 'Unauthorized');
//         }
//         return $next($request);
//     }
// }
