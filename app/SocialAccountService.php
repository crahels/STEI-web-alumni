<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerificationEmail;

class SocialAccountService
{
    public function editGoogleLink(ProviderUser $providerUser, Member $member)
    {
        $account = LinkedSocialAccount::where('provider_name', 'google')
                   ->where('provider_id', $providerUser->getId())
                   ->first();
        
        if ($account){
            if($account->member->id == $member->id){
                $account->delete();
            } else {
                return false;
            }
        }else{
            $temp_provider = $member->accounts()->where('provider_name','=','google')->first();
            if($temp_provider != null)
                $temp_provider->delete();
        }
        $member->email = $providerUser->getEmail();
        $member->save();

        $member->accounts()->create([
            'provider_id'   => $providerUser->getId(),
            'provider_name' => 'google',
        ]);
        return true;
        
    }

    public function findOrLink(ProviderUser $providerUser, Member $member, $provider)
    {
        $account = LinkedSocialAccount::where('provider_name', $provider)
                   ->where('provider_id', $providerUser->getId())
                   ->first();
        
        if ($account) {
            return false;
        } else {
            //dd($member);
            switch($provider){
                case 'facebook':
                    $member->facebook_email = $providerUser->getEmail();
                    break;
                case 'linkedin':
                    $member->linkedin_email = $providerUser->getEmail();
                    break;
                default:
                    break;
            }
            $member->save();

            $member->accounts()->create([
                'provider_id'   => $providerUser->getId(),
                'provider_name' => $provider,
            ]);

            return true;
        }
    }

    public function findOrCreate(ProviderUser $providerUser, $provider)
    {
        $account = LinkedSocialAccount::where('provider_name', $provider)
                   ->where('provider_id', $providerUser->getId())
                   ->first();

        if ($account && $account->member->verified == true) {
            return $account->member;
        } else {
            switch($provider){
                case 'google':
                    $user = Member::where('email', $providerUser->getEmail())->first();
                    break;
                case 'facebook':
                    $user = Member::where('facebook_email', $providerUser->getEmail())->first();
                    break;
                case 'linkedin':
                    $user = Member::where('linkedin_email', $providerUser->getEmail())->first();
                    break;
                default:
                    $user = Member::where('email', $providerUser->getEmail())->first();
                    break;
            }

            if (!$user) {
                //Handle not found
                $user = new Member;
                $user->id = -1;
                $user->verified = false;
            } else {
                $user->accounts()->create([
                    'provider_id'   => $providerUser->getId(),
                    'provider_name' => $provider,
                ]);

                if($provider == "google" && $user->verified == false){
                    $tempUser = new Member;
                    $tempUser->verified = false;
                    if($user->verifyToken == null){
                        $token = $user->verifyToken()->create([
                            'token' => sha1(time())
                        ]);
                        Mail::to($user)->send(new SendVerificationEmail($token));
                        $tempUser->id = -2;
                        return $tempUser;
                    }
                    $tempUser->id = -3;
                    return $tempUser;
                }
            }

            return $user;
        }
    }
}
