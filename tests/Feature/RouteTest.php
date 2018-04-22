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

        $response->assertResponseStatus(200);
    }

    public function testAdd()
    {
        $response = $this->get('admin/add');

        $response->assertResponseStatus(302);
    }

    public function testAddCSV()
    {
        $response = $this->get('admin/addCSV');

        $response->assertResponseStatus(302);
    }

    public function testDashboard()
    {
        $response = $this->get('admin/dashboard');

        $response->assertResponseStatus(302);
    }

    public function testLogin()
    {
        $response = $this->get('admin/login');

        $response->assertResponseStatus(200);
    }

    public function testMembers()
    {
        $response = $this->get('admin/members');

        $response->assertResponseStatus(302);
    }

    public function testPost()
    {
        $response = $this->get('admin/posts');

        $response->assertResponseStatus(200);
    }

    public function testPostCreate()
    {
        $response = $this->get('admin/posts/create');

        $response->assertResponseStatus(302);
    }
}
