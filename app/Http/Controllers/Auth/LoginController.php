<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Mail\verifyEmail;
use Laravel\Socialite\Facades\Socialite;
use File;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $facebookuser = Socialite::driver('facebook')->fields(['first_name', 'last_name', 'email', 'id', 'picture'])->user();
        
        $users = User::where('email', $facebookuser->user['email'])->first();
        if($users === null)
        {
            // get avatar and save to images/avatars

            $avatar = file_get_contents($facebookuser->getAvatar());
            File::put(public_path() . '/images/avatars/' . time() . '_' . $facebookuser->getId() . ".jpg", $avatar);


            // register account because email is not taken
            $user = new User;
            $user->login_type = 'facebook';
            $user->email = $facebookuser->user['email'];
            $user->social_id = $facebookuser->user['id'];
            $user->lastname = $facebookuser->user['last_name'];
            $user->firstname = $facebookuser->user['first_name'];
            $user->verifyStatus = true;
            $user->avatar = time() . '_' . $facebookuser->getId() . ".jpg";
            $user->save();
            Auth::login($user);
            return redirect()->to('/')->with('success', 'Welcome to Techshop28 ' . $facebookuser->user['first_name'] . ' ' . $facebookuser->user['last_name']);
        }
        elseif(User::where('email', $facebookuser->user['email'])->where('social_id', $facebookuser->user['id'])->firstOrFail())
        {
            $user = User::where('email', $facebookuser->user['email'])->where('social_id', $facebookuser->user['id'])->firstOrFail();
            Auth::login($user);
            return redirect()->to('/')->with('success', 'Welcome back ' . $facebookuser->user['first_name'] . ' ' . $facebookuser->user['last_name']);    
        }
    }








    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['verifyStatus'] = 1;
        return $credentials;
    }

    public function resendEmail($email, $verifyToken)
    {
        return "resend";
    }

}
