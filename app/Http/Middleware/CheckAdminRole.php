<?php

namespace App\Http\Middleware;

use App\Models\Person;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role !== Person::ROLES['admin']) {
            return response()->json(['message' => 'not admin']);
        } else {
            return $next($request);
        }
    }
}
