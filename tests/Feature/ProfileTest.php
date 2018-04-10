<?php

namespace Tests\Feature;

use App\Member;
use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class ProfileTest extends TestCase
{
    /**
     * test for profile
     *
     * @return void
     */
    public function testProfileSuccess()
    {
        $member = factory(Member::class)->create();
        $member_dummy = factory(Member::class)->make();
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('/members/' . $member->id . '/edit')
                         ->type($member_dummy->email, 'email')
                         ->type('08988147526', 'phone_number')
                         ->type($member_dummy->company, 'company')
                         ->type($member_dummy->interest, 'interest')
                         ->type($member_dummy->address, 'address')
                         ->attach('storage/app/public/logo_itb.png', 'profile_image')
                         ->press('Submit')
                         ->seePageIs('/members/' . $member->id);
        
        $user->delete();
        $member->delete();
    }

    /**
     * test for profile without company field
     *
     * @return void
     */
    public function testProfileWithoutCompany()
    {
        $member = factory(Member::class)->create();
        $member_dummy = factory(Member::class)->make();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->visit('/members/' . $member->id . '/edit')
                         ->type($member_dummy->email, 'email')
                         ->type('08988147526', 'phone_number')
                         ->type('', 'company')
                         ->type($member_dummy->interest, 'interest')
                         ->type($member_dummy->address, 'address')
                         ->press('Submit')
                         ->seePageIs('/members/' . $member->id . '/edit');
        
        $user->delete();
        $member->delete();
    }

    /**
     * test for profile without address field
     *
     * @return void
     */
    public function testProfileWithoutAddress()
    {
        $member = factory(Member::class)->create();
        $member_dummy = factory(Member::class)->make();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->visit('/members/' . $member->id . '/edit')
                         ->type($member_dummy->email, 'email')
                         ->type('08988147526', 'phone_number')
                         ->type($member_dummy->company, 'company')
                         ->type($member_dummy->interest, 'interest')
                         ->type('', 'address')
                         ->press('Submit')
                         ->seePageIs('/members/' . $member->id);
        
        $user->delete();
        $member->delete();
    }

     /**
     * test for profile without interest field
     *
     * @return void
     */
    public function testProfileWithoutInterest()
    {
        $member = factory(Member::class)->create();
        $member_dummy = factory(Member::class)->make();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->visit('/members/' . $member->id . '/edit')
                         ->type($member_dummy->email, 'email')
                         ->type('08988147526', 'phone_number')
                         ->type($member_dummy->company, 'company')
                         ->type('', 'interest')
                         ->type($member_dummy->address, 'address')
                         ->press('Submit')
                         ->seePageIs('/members/' . $member->id . '/edit');
        
        $user->delete();
        $member->delete();
    }
}
