<?php

namespace App\Http\Middleware\rest;

use Closure;
use Illuminate\Http\Request;
use App\Models\UsersVaksin;
class AuthUsers
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
        $data_users=UsersVaksin::user()->where('login_tokens_users',$request->token)->first();
        if (empty($data_users)) {
            return response()->json([
              'message'=>'Token invalid'
            ],401);
        }
        return $next($request);
    }
}
