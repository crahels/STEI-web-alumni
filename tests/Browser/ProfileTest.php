<?php

namespace Tests\Browser;

use App\User;
use App\Member;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * test for update member without admin credentials
     *
     * @return void
     */
    public function testUpdateMember()
    {
        $member = factory(Member::class)->create();
        $member_dummy = factory(Member::class)->make();
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/Register')
                    ->assertSee('Register Admin');
        });
    }
}
