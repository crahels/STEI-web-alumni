<?php

namespace Tests\Feature;

use App\Member;
use App\User;
use \Auth;

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
                         ->visit('admin/members/' . $member->id . '/edit')
                         ->type('08988147526', 'phone_number')
                         ->type($member_dummy->company, 'company')
                         ->type($member_dummy->interest, 'interest')
                         ->type($member_dummy->address, 'address')
                         ->attach('storage/app/public/logo_itb.png', 'profile_image')
                         ->press('Submit')
                         ->seePageIs('admin/members/' . $member->id);
        
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
                         ->visit('admin/members/' . $member->id . '/edit')
                         ->type('08988147526', 'phone_number')
                         ->type('', 'company')
                         ->type($member_dummy->interest, 'interest')
                         ->type($member_dummy->address, 'address')
                         ->press('Submit')
                         ->seePageIs('admin/members/' . $member->id . '/edit');
        
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
                         ->visit('admin/members/' . $member->id . '/edit')
                         ->type('08988147526', 'phone_number')
                         ->type($member_dummy->company, 'company')
                         ->type($member_dummy->interest, 'interest')
                         ->type('', 'address')
                         ->press('Submit')
                         ->seePageIs('admin/members/' . $member->id);
        
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
                         ->visit('admin/members/' . $member->id . '/edit')
                         ->type('08988147526', 'phone_number')
                         ->type($member_dummy->company, 'company')
                         ->type('', 'interest')
                         ->type($member_dummy->address, 'address')
                         ->press('Submit')
                         ->seePageIs('admin/members/' . $member->id . '/edit');
        
        $user->delete();
        $member->delete();
    }

    /**
     * test see other member
     *
     * @return void
     */
    public function testSeeOtherMember()
    {
        $member = factory(Member::class)->create();
        $member_dummy = factory(Member::class)->create();
        
        Auth::guard('member')->login($member);
        $response = $this->visit('members/' . $member_dummy->id)
                         ->dontSee('Edit Profile')
                         ->see($member_dummy->name)
                         ->see($member_dummy->phone_number)
                         ->see($member_dummy->company)
                         ->see($member_dummy->interest)
                         ->see($member_dummy->address);
        
        $member->delete();
        $member_dummy->delete();
    }

    /**
     * test see other member
     *
     * @return void
     */
    public function testSeeHimselfAsMember()
    {
        $member = factory(Member::class)->create();
        
        Auth::guard('member')->login($member);
        $response = $this->visit('members/' . $member->id)
                         ->see('Edit Profile')
                         ->see($member->name)
                         ->see($member->phone_number)
                         ->see($member->company)
                         ->see($member->interest)
                         ->see($member->address);
        
        $member->delete();
    }

    /**
     * test see other member
     *
     * @return void
     */
    public function testShowMemberAsGuest()
    {
        $member = factory(Member::class)->create();
        
        $response = $this->visit('members/' . $member->id)
                         ->seePageIs('/');
        
        $member->delete();
    }

    /**
     * test edit profile
     *
     * @return void
     */
    public function testEditProfileAsOtherMember()
    {
        $member = factory(Member::class)->create();
        $member_dummy = factory(Member::class)->create();

        Auth::guard('member')->login($member);
        $response = $this->visit('members/' . $member_dummy->id . '/edit')
                         ->seePageIs('/');
        
        $member->delete();
        $member_dummy->delete();
    }

    /**
     * test edit profile
     *
     * @return void
     */
    public function testEditProfileAsGuest()
    {
        $member_dummy = factory(Member::class)->create();

        $response = $this->visit('members/' . $member_dummy->id . '/edit')
                         ->seePageIs('/');

        $member_dummy->delete();
    }

    /**
     * test edit profile
     *
     * @return void
     */
    public function testEditOwnProfile()
    {
        $member = factory(Member::class)->create();

        Auth::guard('member')->login($member);
        $response = $this->visit('members/' . $member->id . '/edit')
                         ->type('08123456789', 'phone_number')
                         ->type('ITB', 'company')
                         ->type('Programming', 'interest')
                         ->type('Address', 'address')
                         ->attach('storage/app/public/logo_itb.png', 'profile_image')
                         ->press('Submit')
                         ->seePageIs('members/' . $member->id);

        $member->delete();
    }

    /**
     * test edit profile
     *
     * @return void
     */
    public function testEditOwnProfileWithoutAddress()
    {
        $member = factory(Member::class)->create();

        Auth::guard('member')->login($member);
        $response = $this->visit('members/' . $member->id . '/edit')
                         ->type('08123456789', 'phone_number')
                         ->type('ITB', 'company')
                         ->type('Programming', 'interest')
                         ->type('', 'address')
                         ->attach('storage/app/public/logo_itb.png', 'profile_image')
                         ->press('Submit')
                         ->seePageIs('members/' . $member->id);

        $member->delete();
    }

    /**
     * test edit profile
     *
     * @return void
     */
    public function testEditOwnProfileWithoutCompanyInterest()
    {
        $member = factory(Member::class)->create();

        Auth::guard('member')->login($member);
        $response = $this->visit('members/' . $member->id . '/edit')
                         ->type('08123456789', 'phone_number')
                         ->type('', 'company')
                         ->type('', 'interest')
                         ->type('Bandung', 'address')
                         ->attach('storage/app/public/logo_itb.png', 'profile_image')
                         ->press('Submit')
                         ->seePageIs('members/' . $member->id . '/edit');

        $member->delete();
    }

    /**
     * test edit profile
     *
     * @return void
     */
    public function testEditOwnProfileWithoutPhoto()
    {
        $member = factory(Member::class)->create();

        Auth::guard('member')->login($member);
        $response = $this->visit('members/' . $member->id . '/edit')
                         ->type('08123456789', 'phone_number')
                         ->type('ITB', 'company')
                         ->type('Programming', 'interest')
                         ->type('Bandung', 'address')
                         ->press('Submit')
                         ->seePageIs('members/' . $member->id);

        $member->delete();
    }
}
