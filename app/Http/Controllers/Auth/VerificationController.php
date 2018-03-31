<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VerifyToken;
use App\Member;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerificationEmail;

class VerificationController extends Controller
{
    public function reverify(VerifyToken $token)
    {
        $token->member->email = $token->member->temp_email;
        $token->member->save();
        $token->delete();
        if(auth()->guard('member')->user() != null){
            auth()->guard('member')->logout();
            return redirect('/login')->with('success', 'Please login again using your new email');
        } else {
            return redirect('/')->with('success', 'Email successfully changed.');
        }
    }

    public function verify(VerifyToken $token)
    {
        //dd($token->member);
        $token->member->verified = true;
        $token->member->save();
        auth()->guard('member')->login($token->member, true);
        $token->delete();
        return redirect('/')->with('success', 'Email verification succesful');
    }
 
    public function resend(Request $request)
    {
        try {
            $user = Member::where('email', $request->email)->firstOrFail();
        }catch(Exception $e){
            abort(404);
        } 

        if($user->verified == true) {
            return redirect('/');
        }
        $token = $user->verifyToken()->create([
            'token' => sha1(time())
        ]);
        Mail::to($user)->send(new SendVerificationEmail($token));
     
        return redirect('/login')->with('success','Verification email resent. Please check your inbox');
    }
}
