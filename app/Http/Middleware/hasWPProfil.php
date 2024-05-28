<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class hasWPProfil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->w_vendor) {
            return $next($request);
        }

        return redirect()->route('wedding-photographer.index')->with('gagal', 'Harap lengkapi profil terlebih dahulu');
    }
}
