<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Socialite;

class TwitterController extends Controller
{

    public function redirectToProvider(){
        return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallback(Request $request){
        try {
            $twitterUser = Socialite::driver('twitter')->user();
        } catch (Exception $e) {
            return redirect('auth/twitter');
        }

        $user = User::where('auth_id', $twitterUser->id)->first();
        if (!$user) {
            $user = User::create([
                'auth_id' => $twitterUser->id,
                'name' => $twitterUser->name
            ]);
        }
        $request->session()->put('userId', $user->id);
        return redirect('/');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('userId');
        return redirect('/');
    }
}
