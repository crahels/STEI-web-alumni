<?php

namespace Tests\Feature;

use App\Member;
use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;

class AddMemberTest extends TestCase
{
    /**
     * test add member manual
     *
     * @return void
     */
    public function testAddMemberManualSuccess()
    {
        $member = factory(Member::class)->make();
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('/add')
                         ->type($member->name, 'name')
                         ->type($member->nim, 'nim')
                         ->type($member->email, 'email')
                         ->type('08988147532', 'phone_number')
                         ->press('Submit')
                         ->seePageIs('/members');
        
        $member = Member::where('nim', $member->nim)->first();
        $member->delete();

        $user->delete();
    }

    /**
     * test add member manual
     *
     * @return void
     */
    public function testAddMemberManualWithoutName()
    {
        $member = factory(Member::class)->make();
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('/add')
                         ->type('', 'name')
                         ->type($member->nim, 'nim')
                         ->type($member->email, 'email')
                         ->type('08988147532', 'phone_number')
                         ->press('Submit')
                         ->seePageIs('/add');
        
        $user->delete();

    }

    /**
     * test add member manual
     *
     * @return void
     */
    public function testAddMemberManualWithoutEmail()
    {
        $member = factory(Member::class)->make();
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('/add')
                         ->type($member->name, 'name')
                         ->type($member->nim, 'nim')
                         ->type('', 'email')
                         ->type('08988147532', 'phone_number')
                         ->press('Submit')
                         ->seePageIs('/add');
        
        $user->delete();

    }

    /**
     * test add member manual
     *
     * @return void
     */
    public function testAddMemberManualWithoutPhone()
    {
        $member = factory(Member::class)->make();
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('/add')
                         ->type($member->name, 'name')
                         ->type($member->nim, 'nim')
                         ->type($member->email, 'email')
                         ->type('', 'phone_number')
                         ->press('Submit')
                         ->seePageIs('/add');
        
        $user->delete();
    }

    /**
     * test add member CSV
     *
     * @return void
     */
    public function testAddMemberCSV()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('/addCSV')
                         ->attach('storage/app/public/test.csv', 'list_members')
                         ->press('Submit')
                         ->see('Members Imported');
        
        $user->delete();

        $dummy = Member::where('email', 'testone@gmail.com')->first();
        $dummy->delete();
        
        $dummy = Member::where('email', 'testtwo@gmail.com')->first();
        $dummy->delete();

        $dummy = Member::where('email', 'testthree@gmail.com')->first();
        $dummy->delete();
    }

    /**
     * test add member CSV with no file
     *
     * @return void
     */
    public function testAddMemberCSVFail()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('/addCSV')
                         ->press('Submit')
                         ->see('No CSV File');
        
        $user->delete();
    }

    /**
     * test add member CSV with wrong extension
     *
     * @return void
     */
    public function testAddMemberCSVFailWrongExtension()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('/addCSV')
                         ->attach('storage/app/public/logo_itb.png', 'list_members')
                         ->press('Submit')
                         ->see('Wrong File Extension');
        
        $user->delete();
    }
}
