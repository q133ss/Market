<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function index()
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function callback(Request $request)
    {
        $user = Socialite::driver('vkontakte')->user();

        $data = [
             'email' => $user->getEmail() != null ? $user->getEmail() : str_replace(" ", '', $user->getName()).'@vkauth.ru',
             'name' => $user->getName(),
             'password' => '1111',
             'social_auth' => 1,
             'role_id' => '2'
         ];

        $u = User::where(['email' => $user->getEmail()])->orWhere(['email' => str_replace(" ", '', $user->getName()).'@vkauth.ru']);

        if($u->exists()){
            Auth::loginUsingId($u->pluck('id')->first());
        }else{
            $usr = User::create($data);
            Auth::loginUsingId($usr->id);
//            File::where('fileable_type', 'App\Models\User')->where('fileable_id', $usr->id)->where('category', 'avatar')->delete();
            File::create(['fileable_type' => 'App\Models\User', 'fileable_id' => $usr->id, 'category' => 'avatar', 'src' => $user->getAvatar()]);
        }

        return to_route('account');
    }

    public function okIndex()
    {
        return Socialite::driver('odnoklassniki')->redirect();
    }

    public function okCallback(Request $request)
    {
        $user = Socialite::driver('odnoklassniki')->user();

        $data = [
            'email' => $user->getEmail() != null ? $user->getEmail() : str_replace(" ", '', $user->getName()).'@okauth.ru',
            'name' => $user->getName(),
            'password' => '1111',
            'social_auth' => 1,
            'role_id' => '2'
        ];

        $u = User::where(['email' => $user->getEmail()])->orWhere(['email' => str_replace(" ", '', $user->getName()).'@okauth.ru']);

        if($u->exists()){
            Auth::loginUsingId($u->pluck('id')->first());
        }else{
            $usr = User::create($data);
            Auth::loginUsingId($usr->id);
//            File::where('fileable_type', 'App\Models\User')->where('fileable_id', $usr->id)->where('category', 'avatar')->delete();
            File::create(['fileable_type' => 'App\Models\User', 'fileable_id' => $usr->id, 'category' => 'avatar', 'src' => $user->getAvatar()]);
        }

        return to_route('account');
    }
}
