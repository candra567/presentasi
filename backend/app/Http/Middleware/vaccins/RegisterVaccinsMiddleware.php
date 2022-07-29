<?php

namespace App\Http\Middleware\vaccins;

use App\Models\Consultations;
use App\Models\RegisterVaccins;
use App\Models\UsersVaksin;
use Closure;
use Illuminate\Http\Request;
class RegisterVaccinsMiddleware
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
        $first_consultations=Consultations::consultations()->where('id_card_users_vaksin',session()->get('id'))->where('number_consultations',1)->first();
        $seconds_consultations=Consultations::consultations()->where('id_card_users_vaksin',session()->get('id'))->where('number_consultations',2)->first();
        if (empty($first_consultations)&&empty($seconds_consultations)) {
           return response()->json('Can,t access now');
        }
        else if(!empty($first_consultations)){
            if ($first_consultations->status_consultations=='pending') {
                return response()->json('Can,t access now');
            }
        }
        else if(!empty($seconds_consultations)){
            if ($seconds_consultations->status_consultations=='pending') {
                return response()->json('Can,t access now');
            }
        }

        return $next($request);
    }
}
