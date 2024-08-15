<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isVendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'vendor') {
            return redirect()->route('ke_masuk')->with('gagal', 'Anda perlu login dengan akun vendor terlebih dahulu');
        }
        return $next($request);
    }
}