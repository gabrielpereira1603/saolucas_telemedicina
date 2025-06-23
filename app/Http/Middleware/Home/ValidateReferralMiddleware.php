<?php

namespace App\Http\Middleware\Home;

use App\Models\SubAcquirer;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateReferralMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $referral = $request->route('referral');

        if ($referral && !SubAcquirer::where('prefix_url', $referral)->exists()) {
            return redirect()->route('home');
        }

        return $next($request);
    }

}
