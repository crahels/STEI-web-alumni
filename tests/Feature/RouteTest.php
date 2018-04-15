<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RouteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRoot()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testAdd()
    {
        $response = $this->get('/add');

        $response->assertStatus(302);
    }

    public function testAddCSV()
    {
        $response = $this->get('/addCSV');

        $response->assertStatus(302);
    }

    public function testAddmember()
    {
        $response = $this->get('/addmember');

        $response->assertStatus(302);
    }

    public function testDashboard()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
    }

    public function testLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testRegister()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testMembers()
    {
        $response = $this->get('/members');

        $response->assertStatus(302);
    }

    public function testMembersCreate()
    {
        $response = $this->get('/members/create');

        $response->assertStatus(302);
    }

    public function testProfile()
    {
        $response = $this->get('/profile');

        $response->assertStatus(302);
    }

    public function testPost()
    {
        $response = $this->get('/posts');

        $response->assertStatus(500);
    }

    public function testPostCreate()
    {
        $response = $this->get('/posts/create');

        $response->assertStatus(200);
    }
}
