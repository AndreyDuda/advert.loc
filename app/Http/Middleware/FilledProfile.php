<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 15.01.19
 * Time: 23:09
 */

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

class FilledProfile
{
    public function handle($request, \Closure $next)
    {

        /** @var User $user */
        $user = Auth::user();

        if (empty($user->name) || empty($user->last_name) || empty($user->phone)) {
            return redirect()
                ->route('cabinet.profile.home')
                ->with('error', 'Please fill your profile.');
        }

        return $next($request);
    }

}
