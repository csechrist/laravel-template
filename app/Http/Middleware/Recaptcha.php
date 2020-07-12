<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use App;

class Recaptcha {
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @param  string  $action
    * @return mixed
    */

    public function handle( $request, Closure $next, $action ) {
        if ( App::environment( 'testing' ) ) {
            $request->merge( ['recaptcha_score' => $request->input( 'recaptcha' )] );
            return $next( $request );
        }

        if ( !Config::get( 'services.recaptcha.enabled' ) ) return $next( $request );
        $secret = Config::get( 'services.recaptcha.secret' );

        $response = ( new \ReCaptcha\ReCaptcha( $secret ) )
        ->setExpectedAction( $action )
        ->verify( $request->input( 'recaptcha' ), $request->ip() );

        if ( !$response->isSuccess() && $response->getScore() <= 0.3 ) {
            return back()->withError( 'recaptcha', 'Looks like we had an issue with ReCaptcha.' );
        }

        $request->merge( ['recaptcha_score' => $response->getScore()] );

        return $next( $request );
    }
}
