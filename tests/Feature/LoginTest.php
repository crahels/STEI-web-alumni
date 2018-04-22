<?php

namespace Tests\Feature;

use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * test for register
     *
     * @return void
     */
    public function testRegisterSuccess()
    {
        $user = factory(User::class)->make([
            'name' => 'Laravel Testing',
            'email' => 'laraveltesting@gmail.com',
            'password' => 'laraveltesting'
        ]);

        $this->visit('admin/register')
             ->type($user->name, 'name')
             ->type($user->email, 'email')
             ->type($user->password, 'password')
             ->type($user->password, 'password_confirmation')
             ->press('Register')
             ->seePageIs('/');
    }

    /**
     * test for login success
     *
     * @return void
     */
    public function testLoginSuccess()
    {
        $user = factory(User::class)->make([
            'name' => 'Laravel Testing',
            'email' => 'laraveltesting@gmail.com',
            'password' => 'laraveltesting'
        ]);

        $this->visit('admin/login')
             ->type($user->email, 'email')
             ->type($user->password, 'password')
             ->press('Login')
             ->seePageIs('admin/dashboard');

        $user = User::where('email', $user->email)->first();
        $user->delete();
    }

    /**
     * test for login fail
     *
     * @return void
     */
    public function testLoginFail()
    {
        $user = factory(User::class)->make();

        $this->visit('admin/login')
             ->type($user->email, 'email')
             ->type($user->password, 'password')
             ->press('Login')
             ->seePageIs('admin/login');
    }
}
