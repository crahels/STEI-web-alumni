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
                         ->press('Submit')
                         ->seePageIs('admin/posts')
                         ->see('Post Updated');

        $post->delete();
        $user->delete();
    }
}
