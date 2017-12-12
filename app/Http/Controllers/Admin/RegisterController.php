<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Image;
use Mail;
use App\Mail\verifyEmail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'mobilenumber' => 'required|regex:/(09)[0-9]{9}/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // 'avatar' => 'required|image|max:1999',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $request = app('request');
        $filler = time();

        if($request->hasfile('avatar')){
            $avatar = $request->file('avatar');
            $filename = $filler . '_' . $avatar->getClientOriginalName();
            Image::make($avatar)->resize(300, 300)->save( public_path('/images/avatars/' . $filename) );
        }

        $user = User::create([
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'mobilenumber' => $data['mobilenumber'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => $filler . '_' . $data['avatar']->getClientOriginalName(),
            'verifyToken' => Str::random(40),
        ]);

        $thisUser = User::findOrFail($user->id);
        $this->sendEmail($thisUser);
        return $user;
    }

    public function sendEmail($thisUSer)
    {
        Mail::to($thisUSer['email'])->send(new verifyEmail($thisUSer));
    }

    public function sendEmailDone($email, $verifyToken)
    {
        $user = User::where('email', $email)->where('verifyToken', $verifyToken)->first();
        if ($user) {
            $user->verifyStatus = true;
            $user->verifyToken = NULL;
            $user->save();
            return redirect()->to('/')->with('success', 'Your email is now verified');
        }else{
            return redirect()->to('/')->with('error', 'User not found');
        }

    }



}
