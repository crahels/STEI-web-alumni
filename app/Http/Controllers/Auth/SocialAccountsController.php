<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\SocialAccountService;

use Socialite;

class SocialAccountsController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest:member', ['except' => ['handleProviderCallback','logout']]);
    }


    public function index()
    {
        return view('members.login');
    }

    /**
     * Redirect the user to the Linkedin authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Linkedin.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(SocialAccountService $accountService, $provider)
    {
        //dd($_GET);
        //dd($accountService);
        //dd(auth()->guard('member')->user());

        try {
            $user = Socialite::with($provider)->user();
        } catch (Exception $e) {
            return redirect('/login');
        }
        if(auth()->guard('member')->user() != null){
            $linkStatus = $accountService->findOrLink(
                $user,
                auth()->guard('member')->user(),
                $provider
            );
            if($linkStatus)
                return redirect()->to('/members/'.auth()->guard('member')->user()->id)->with('success',ucfirst($provider).' account successfully linked');
            else
                return redirect()->to('/members/'.auth()->guard('member')->user()->id)->with('error',ucfirst($provider).' account already linked');

        } else {
            $authUser = $accountService->findOrCreate(
                $user,
                $provider
            );
            //dd($authUser);
            switch($authUser->id){
                case -1:
                    return redirect()->to('/login')->with('error','Email not recorded in system');
                case -2:
                    return redirect()->to('/login')->with('success', 'Activation mail has been sent to your email'); 
                case -3:
                    return redirect()->to('/login')->with('error', 'Please activate your account. <a href="' . route('auth.verify.resend') . '?email=' . $user->email .'">Resend?</a>'); 
                default:
                    auth()->guard('member')->login($authUser, true);
                    return redirect()->to('/');
            }
        }

        //auth()->guard('member')->login($authUser, true);
        //dd(auth()->guard('member')->user());
        //return redirect()->to('/');
    }

    public function logout()
    {
        auth()->guard('member')->logout();
        return redirect('/login');
    }
}