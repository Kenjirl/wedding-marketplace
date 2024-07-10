<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class hasUserProfile
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
        if (auth()->user()->w_couple) {
            return $next($request);
        }

        return redirect()->route('wedding-couple.index')->with('gagal', 'Harap lengkapi profil terlebih dahulu');
    }
}
