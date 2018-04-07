<?php

namespace App\Http\Middleware;

use Closure;

class RoleManagement
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $restricted)
    {
        if(auth()->user()->isAdmin()){
            return $next($request);
        }
        if($restricted== 'true'){
            if(auth()->user()->isAgent()){
              return $next($request);
            }
        }
        
        return redirect('home');
    }
    
}
