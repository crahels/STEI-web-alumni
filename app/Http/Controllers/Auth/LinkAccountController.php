<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SocialAccountService;

use Socialite;

class LinkAccountController extends Controller
{
    public function __construct()
    {
      $this->middleware('member.login');
    }


    /**
     * Redirect the user to the authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function deleteLink($provider){
        $user = auth()->guard('member')->user();
        $providerUser = $user->accounts()->where('provider_name','=',$provider)->first();
        if($providerUser == null)
            return redirect('/members/'.$user->id);
        else
            $providerUser->delete();
        switch($provider){
            case 'facebook':
                $user->facebook_email = null;
                $user->save();
                break;
            case 'linkedin':
                $user->linkedin_email = null;
                $user->save();
                break;
            default:
                return redirect('/members/'.$user->id);
                break;
        }
        return redirect('/members/'.$user->id)->with('success','Deleted '.$provider.' Link');
    }
}
