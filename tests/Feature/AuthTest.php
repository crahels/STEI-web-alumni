<?php

namespace Tests\Feature;

use App\User;
use App\Member;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
     /**
     * test for load dashboard with admin credentials
     *
     * @return void
     */
    public function testLoadDashboardSuccess()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
                         ->get('/dashboard');

        $response->assertResponseStatus(200);

        $user->delete();
    }

    /**
     * test for show dashboard without admin credentials
     *
     * @return void
     */
    public function testDashboardFail()
    {
        $response = $this->get('/dashboard');

        $response->assertResponseStatus(302);
    }

    /**
     * test for load member with admin credentials
     *
     * @return void
     */
    public function testLoadMembersSuccess()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
                         ->get('/members');

        $response->assertResponseStatus(200);

        $user->delete();
    }

     /**
     * test for load member without admin credentials
     *
     * @return void
     */
    public function testLoadMembersFail()
    {
        $response = $this->get('/members');

        $response->assertResponseStatus(302);
    }

    /**
     * test for load post with admin credentials
     *
     * @return void
     */
    public function testLoadPostsSuccess()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
                         ->get('/posts');

        $response->assertResponseStatus(200);

        $user->delete();
    }

     /**
     * test for load member without admin credentials
     *
     * @return void
     */
    public function testLoadPostsFail()
    {
        $response = $this->get('/posts');

        $response->assertResponseStatus(302);
    }

    /**
     * test for load add member with admin credentials
     *
     * @return void
     */
    public function testLoadAddMemberSuccess()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
                         ->get('/add');

        $response->assertResponseStatus(200);

        $user->delete();
    }

     /**
     * test for load add member without admin credentials
     *
     * @return void
     */
    public function testLoadAddMemberFail()
    {
        $response = $this->get('/add');

        $response->assertResponseStatus(302);
    }

    /**
     * test for load add CSV with admin credentials
     *
     * @return void
     */
    public function testLoadAddCSVSuccess()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
                         ->get('/addCSV');

        $response->assertResponseStatus(200);

        $user->delete();
    }

     /**
     * test for load add CSV without admin credentials
     *
     * @return void
     */
    public function testLoadAddCSVFail()
    {
        $response = $this->get('/addCSV');

        $response->assertResponseStatus(302);
    }

     /**
     * test for load create post with admin credentials
     *
     * @return void
     */
    public function testLoadCreatePostSuccess()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
                         ->get('/posts/create');

        $response->assertResponseStatus(200);

        $user->delete();
    }

     /**
     * test for load create post without admin credentials
     *
     * @return void
     */
    public function testLoadCreatePostFail()
    {
        $response = $this->get('/posts/create');

        $response->assertResponseStatus(302);
    }

     /**
     * test for load each member with admin credentials
     *
     * @return void
     */
    public function testLoadMemberSuccess()
    {
        $member = factory(Member::class)->create();

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
                         ->get('/members/' . $member->id);

        $response->assertResponseStatus(200);

        $response = $this->get('/members/' . $member->id . '/edit');

        $response->assertResponseStatus(200);

        $response = $this->get('/members/' . $member->id . '/delete');

        $response->assertResponseStatus(302);

        $this->notSeeInDatabase('members', ['id' => $member->id]);

        $user->delete();
        $member->delete();
    }

     /**
     * test for load each member without admin credentials
     *
     * @return void
     */
    public function testLoadMemberFail()
    {
        $member = factory(Member::class)->create();

        $response = $this->get('/members/' . $member->id);

        $response->assertResponseStatus(200);

        $response = $this->get('/members/' . $member->id . '/edit');

        $response->assertResponseStatus(200);

        $response = $this->get('/members/' . $member->id . '/delete');
        
        $response->assertResponseStatus(302);

        $this->seeInDatabase('members', ['id' => $member->id]);

        $member->delete();
    }
}
