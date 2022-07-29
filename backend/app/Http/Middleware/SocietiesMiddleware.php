<?php

namespace App\Http\Middleware;

use App\Models\Societies;
use Closure;
use Illuminate\Http\Request;

class SocietiesMiddleware
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
        $data_societies=Societies::societies()->where('login_tokens',$request->token)->first();
        if (empty($data_societies)) {
            return response()->json([
              'message'=>'token invalid'
            ],401);
        }
        return $next($request);
    }
}
