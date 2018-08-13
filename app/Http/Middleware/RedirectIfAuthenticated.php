<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    
    /* public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    } */
    public function handle($request, Closure $next, $guard = null)
    {
      switch ($guard) {
        case 'admin':
          if (Auth::guard($guard)->check()) {
            return redirect()->route('admin.index');
          }
          break;
          case 'doctor':
          if (Auth::guard($guard)->check()) {
            return redirect()->route('doctor.dashboard');
          }
          break;
          /* case 'consultant':
          if (Auth::guard($guard)->check()) {
            return redirect()->route('consultant.dashboard');
          }
          break; */
        default:
          if (Auth::guard($guard)->check()) {
              return redirect('/');
          }
          break;
      }
      return $next($request);
    }
}
