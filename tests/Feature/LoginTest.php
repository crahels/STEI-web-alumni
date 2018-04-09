<?php

namespace Tests\Feature;

use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * test for load each member without admin credentials
     *
     * @return void
     */
    public function testLogin()
    {
        
        $this->visit('/login')
             ->type('sidney.rachel@gmail.com', 'email')
             ->type('rererachel', 'password')
             ->press('Login')
             ->seePageIs('/dashboard');
    }
}
