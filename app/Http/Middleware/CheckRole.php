<?php

namespace App\Http\Middleware;

use App\Models\Route;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $get_user_role  = Auth::user()->role_id;
        $route = request()->segment(1);
        $second_route = request()->segment(2);
        if (Auth::check() && Auth::user()->is_user_verified == 2) {
            return redirect()->route('profile.update');
        }

        if($get_user_role == 1){
            return $next($request);
        }
        if($get_user_role == 5 && $route == "assign-lead"){

            return $next($request);
        }
        if(($get_user_role == 5 || $get_user_role == 6 || $get_user_role == 7 ) && $route == 'lead' ){
            return $next($request);
        }
        if(($get_user_role == 5 || $get_user_role == 6 || $get_user_role == 7 ) && $route == 'note' ){
            return $next($request);
        }
        if(($get_user_role == 5 || $get_user_role == 6 || $get_user_role == 7 ) && $route == 'change-status' ){
            return $next($request);
        }
        if(($get_user_role == 5 || $get_user_role == 6 || $get_user_role == 7 ) && $route == 'dashboard' ){
            return $next($request);
        }

        if($get_user_role == 2 && $route == 'dashboard' ){
            return $next($request);
        }
        if($get_user_role == 2 && $route == 'note' ){
            return $next($request);
        }
        if(($get_user_role == 5 || $get_user_role == 6 || $get_user_role == 7 ) && $route == 'profile-update' ){
            return $next($request);
        }
        if(($get_user_role == 5 || $get_user_role == 6 || $get_user_role == 7 ) && $route == 'member' && $second_route == "update" ){
            return $next($request);
        }
        return redirect(route('dashboard'));
    }
}
