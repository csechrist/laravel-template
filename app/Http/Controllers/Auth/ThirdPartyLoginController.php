<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Socialite;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\UserConnection;
use App\Models\User;
use Auth;

class ThirdPartyLoginController extends Controller {

    /**
    * Where to redirect users after successful oAuth login.
    *
    * @var string
    */

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
    * Redirect the user to the Twitter authentication page.
    *
    * @param string $provider
    * @return \Illuminate\Http\Response
    */

    public function redirectToProvider( string $provider ) {
        return Socialite::driver( $provider )->redirect();
    }

    /**
    * Obtain the user information from Twitter.
    *
    * @param string $provider
    * @return \Illuminate\Http\Response
    */

    public function handleCallback( string $provider ) {
        $user = Socialite::driver( $provider )->user();

        return $this->handleLogin( $provider, $user );
    }

    /**
    * Handle the login
    *
    * @param string $provider
    * @param
    */

    protected function handleLogin( $provider, $user ) {
        $conn = UserConnection::where( 'provider', $provider )->where( 'provider_id', $user->getId() )->first();

        if ( $conn ) {
            // User exists, authenticate them...  Store data in session
            if ( $user_account = $conn->user ) {
                Auth::login( $user_account );

                return redirect( $this->redirectTo );
            } else {
                // Something is wrong here...  We shouldn't have a oAuth session with no user
                throw new Exception( 'OAuth exists without a user!' );
            }
        } else {
            // User does not exist, register then authenticate them... Store data in session
            $user_account = User::where('email', $user->getEmail() )->first();

            if ( $user_account ) {
                // Create a new association to save user's auth credentials

                // Force user to login w/ password or other auth method to link?  Not right now but eventually add this here

                $user_connection = new UserConnection();
                $user_connection->provider = $provider;
                $user_connection->user_id = $user_account->id;
                $user_connection->provider_id = $user->getId();

                $user_connection->save();

                // Potentially could dispatch an email here to send a 'Linked Account' email

                Auth::login( $user_account );

                return redirect( $this->redirectTo )->with( ['message' => 'Successfully linked your ' . $provider . ' account.', 'alert-type' => 'success'] );

            } else {
                // User does not exist therefore, create a new account
                $user_account = new User();
                $user_account->name = $user->getName();
                $user_account->email = $user->getEmail();
                $user_account->email_verified_at = Carbon::now();

                $user_account->save();

                $user_connection = new UserConnection();
                $user_connection->provider = $provider;
                $user_connection->user_id = $user_account->id;
                $user_connection->provider_id = $user->getId();

                $user_connection->save();

                Auth::login( $user_account );

                return redirect( $this->redirectTo );

            }
        }
    }
}
