<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if(!(Auth::user()->roles->pluck('type')->contains('ADMIN')))
            {
                if ($request->wantsJson()) {
                    return response()->json([
                        "serverResponse" => [
                            "code" => 200,
                            "message" => "Permission Denied",
                            "isSuccess" => false
                        ]
                        ]);
                }
            }
        }
        return $next($request);
    }
}
