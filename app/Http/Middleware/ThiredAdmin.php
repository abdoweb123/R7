<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ThiredAdmin
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
        if (auth()->user() != null) {
            if (request()->is('ar/traning-course') && auth()->user()->hasPermissionTo('الدورات التدريبيه')) {
                return $next($request);
            }elseif (request()->is('ar/user-traning') && auth()->user()->hasPermissionTo('اضافه دوره لمستخدم')) {
                return $next($request);
            }elseif (request()->is('ar/absences') && auth()->user()->hasPermissionTo('الغيابات')) {
                return $next($request);
            }elseif (request()->is('ar/user-moey') && auth()->user()->hasPermissionTo('التحويلات')) {
                return $next($request);
            }elseif (request()->is('ar/tranings') && auth()->user()->hasPermissionTo('تقرير الدورات التدريبيه')) {
                return $next($request);
            }elseif (request()->is('ar/employments') && auth()->user()->hasPermissionTo('التوظيف')) {
                return $next($request);
            }elseif (request()->is('ar/latest') && auth()->user()->hasPermissionTo('التاخير')) {
                return $next($request);
            }else{
                abort(403);
            }
        }elseif (auth('company')->user() != null) {
            return $next($request);
        }
        abort(403);
    }
}
