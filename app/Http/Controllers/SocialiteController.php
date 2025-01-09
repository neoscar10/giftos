<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    // this function is to redirect to google only
    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }

    // will auth the user through google
    public function googleAuthentication(){
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

        $user =User::where('google_id', $googleUser->id)->first();

        if ($user){
            Auth::login($user);
            return redirect('/');
        }else{
            $userData=User::create([
                'name'=>$googleUser->name,
                'email'=>$googleUser->email,
                'password' => Hash::make('password@1234'),
                'google_id'=>$googleUser->id,
            ]);
        if($userData){
            Auth::login($userData);
            return redirect('/');
        }
        }
    }
         catch (Exception $e) {
            dd($e);
        }
}}
