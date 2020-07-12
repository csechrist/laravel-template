<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Redirect;
use Auth;

class IsVerifiedExceptFirst {
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    */

    public function handle( $request, Closure $next ) {
        $first_login =  Session::get( 'first_login', false );

        if ( !$request->user() ||
        ( $request->user() instanceof MustVerifyEmail &&
        ! $request->user()->hasVerifiedEmail() && !$first_login ) ) {
            Auth::logout();
            Session::flush();
            return $request->expectsJson()
            ? abort( 403, 'Your email address is not verified.' )
            : Redirect::route( 'verification.notice' );
        }

        return $next( $request );
    }
}
