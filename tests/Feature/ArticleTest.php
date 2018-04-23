<?php

namespace Tests\Feature;

use App\Post;
use App\Member;
use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    /**
     * test create article
     *
     * @return void
     */
    public function testCreateArticleSuccess()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('admin/posts/create')
                         ->type('Post for Testing', 'title')
                         ->type('Post Body', 'body')
                         ->check('public')
                         ->uncheck('draft')
                         ->attach('storage/app/public/logo_itb.png', 'cover_image')
                         ->press('Submit')
                         ->seePageIs('admin/posts')
                         ->see('Post Created');
        
        $dummy = Post::where('title', 'Post for Testing')->first();
        $dummy->delete();

        $user->delete();
    }

    /**
     * test create article without title
     *
     * @return void
     */
    public function testCreateArticleWithoutTitle()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('admin/posts/create')
                         ->type('', 'title')
                         ->type('Post Body', 'body')
                         ->check('public')
                         ->uncheck('draft')
                         ->attach('storage/app/public/logo_itb.png', 'cover_image')
                         ->press('Submit')
                         ->seePageIs('admin/posts/create')
                         ->see('The title field is required.');

        $user->delete();
    }

    /**
     * test create article without body
     *
     * @return void
     */
    public function testCreateArticleWithoutBody()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('admin/posts/create')
                         ->type('Post for Testing', 'title')
                         ->type('', 'body')
                         ->check('public')
                         ->uncheck('draft')
                         ->attach('storage/app/public/logo_itb.png', 'cover_image')
                         ->press('Submit')
                         ->seePageIs('admin/posts/create')
                         ->see('The body field is required.');

        $user->delete();
    }

    /**
     * test create article without thumbnail
     *
     * @return void
     */
    public function testCreateArticleWithoutThumbnail()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('admin/posts/create')
                         ->type('Post for Testing', 'title')
                         ->type('Post Body', 'body')
                         ->check('public')
                         ->uncheck('draft')
                         ->press('Submit')
                         ->seePageIs('admin/posts')
                         ->see('Post Created');

        $dummy = Post::where('title', 'Post for Testing')->first();
        $dummy->delete();

        $user->delete();
    }

    /**
     * test edit article
     *
     * @return void
     */
    public function testEditArticle()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id' => $user->id
        ]);
        
        $response = $this->actingAs($user)
                         ->visit('admin/posts/' . $post->id . '/edit')
                         ->type('Post for Testing', 'title')
                         ->type('Post Body', 'body')
                         ->attach('storage/app/public/logo_itb.png', 'cover_image')
                         ->check('public')
                         ->uncheck('draft')
                         ->press('Submit')
                         ->seePageIs('admin/posts')
                         ->see('Post Updated');
                         
        $post->delete();

        $user->delete();
    }

    /**
     * test edit article without title
     *
     * @return void
     */
    public function testEditArticleWithoutTitle()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id' => $user->id
        ]);
        
        $response = $this->actingAs($user)
                         ->visit('admin/posts/' . $post->id . '/edit')
                         ->type('', 'title')
                         ->type('Post Body', 'body')
                         ->attach('storage/app/public/logo_itb.png', 'cover_image')
                         ->check('public')
                         ->uncheck('draft')
                         ->press('Submit')
                         ->seePageIs('admin/posts/' . $post->id . '/edit')
                         ->see('The title field is required.');
        
        $post->delete();
        $user->delete();
    }

    /**
     * test edit article
     *
     * @return void
     */
    public function testEditArticleWithoutBody()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id' => $user->id
        ]);
        
        $response = $this->actingAs($user)
                         ->visit('admin/posts/' . $post->id . '/edit')
                         ->type('Post for Testing', 'title')
                         ->type('', 'body')
                         ->attach('storage/app/public/logo_itb.png', 'cover_image')
                         ->check('public')
                         ->uncheck('draft')
                         ->press('Submit')
                         ->seePageIs('admin/posts/' . $post->id . '/edit')
                         ->see('The body field is required.');

        $post->delete();
        $user->delete();
    }

    /**
     * test edit article
     *
     * @return void
     */
    public function testEditArticleWithoutThumbnail()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id' => $user->id
        ]);
        
        $response = $this->actingAs($user)
                         ->visit('admin/posts/' . $post->id . '/edit')
                         ->type('Post for Testing', 'title')
                         ->type('Post Body', 'body')
                         ->check('public')
                         ->uncheck('draft')
                         ->press('Submit')
                         ->seePageIs('admin/posts')
                         ->see('Post Updated');

        $post->delete();
        $user->delete();
    }

    /**
     * test edit article
     *
     * @return void
     */
    public function testEditArticlePublicDraft()
    {
        $user = factory(User::class)->create();
        $post_first = factory(Post::class)->create([
            'user_id' => $user->id,
            'title' => 'Post for Testing 1',
            'public' => 1,
            'draft' => 1
        ]);

        $post_second = factory(Post::class)->create([
            'user_id' => $user->id,
            'title' => 'Post for Testing 2',
            'public' => 1,
            'draft' => 0
        ]);

        $post_third = factory(Post::class)->create([
            'user_id' => $user->id,
            'title' => 'Post for Testing 3',
            'public' => 0,
            'draft' => 1
        ]);
        
        $post_fourth = factory(Post::class)->create([
            'user_id' => $user->id,
            'title' => 'Post for Testing 4',
            'public' => 0,
            'draft' => 0
        ]);

        $response = $this->visit('admin/posts')
                         ->see('Post for Testing 2')
                         ->dontSee('Post for Testing 1')
                         ->dontSee('Post for Testing 3')
                         ->dontSee('Post for Testing 4');

        $response = $this->actingAs($user)
                         ->visit('admin/posts')
                         ->see('Post for Testing 2')
                         ->see('Post for Testing 4')
                         ->see('Post for Testing 1')
                         ->see('Post for Testing 3');

        $post_first->delete();
        $post_second->delete();
        $post_third->delete();
        $post_fourth->delete();

        $user->delete();
    }
}
