<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{

    public function handle($request, Closure $next)
    {

        if (Auth::check()){     //check if the user is login
            if (Auth::user()->isAdmin()) {  //if ang user admin ba
                return $next($request); //go the next request of the application
            }

        }

        return redirect('/'); //balik sa homepage if false cya

    }
}
