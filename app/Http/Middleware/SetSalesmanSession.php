<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SetSalesmanSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->roles && $user->roles->isNotEmpty()) {
            if ($user->roles->first()->name === 'Salesman') {
                $srec = DB::table('salesman')
                    ->where('name', $user->name)
                    ->select('id')
                    ->first();

                if ($srec) {
                    session(['salesman_id' => $srec->id]);
                }
            }
        }

        return $next($request);
    }
}
