<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Payment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user has paid for the exams he wishes to gain access to
        $userId = Auth::id();
        $payment = \App\Payment::where('user_id', $userId)->where('class', $request->exam)->count();
        if ($payment) {
            return $next($request);
        }
        return redirect("payment/$request->exam");
    }
}
