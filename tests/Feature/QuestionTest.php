<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Question;
use App\User;
use App\Member;

class QuestionTest extends TestCase
{
    /**
     * test add question
     *
     * @return void
     */
    public function testAddQuestionSuccess()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('admin/questions')
                         ->click('Add Question')
                         ->seePageIs('admin/questions/create')
                         ->type('Question for Testing', 'topic')
                         ->type('Is This Question One?', 'body')
                         ->press('Add')
                         ->see('Question Added');
        
        $dummy = Question::where('topic', 'Question for Testing')->first();
        $dummy->delete();

        $user->delete();
    }

    /**
     * test add question without topic
     *
     * @return void
     */
    public function testAddQuestionWithoutTopic()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('admin/questions')
                         ->click('Add Question')
                         ->seePageIs('admin/questions/create')
                         ->type('', 'topic')
                         ->type('Is This Question One?', 'body')
                         ->press('Add')
                         ->see('The topic field is required.');
        
        $user->delete();
    }

    /**
     * test add question without body
     *
     * @return void
     */
    public function testAddQuestionWithoutBody()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('admin/questions')
                         ->click('Add Question')
                         ->seePageIs('admin/questions/create')
                         ->type('Question for Testing', 'topic')
                         ->type('', 'body')
                         ->press('Add')
                         ->see('The body field is required.');
        
        $user->delete();
    }

    /**
     * test add question without topic and body
     *
     * @return void
     */
    public function testAddQuestionWithoutBodyTopic()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('admin/questions')
                         ->click('Add Question')
                         ->seePageIs('admin/questions/create')
                         ->type('', 'topic')
                         ->type('', 'body')
                         ->press('Add')
                         ->see('The topic field is required.')
                         ->see('The body field is required.');
        
        $user->delete();
    }

    /**
     * test add question
     *
     * @return void
     */
    public function testShowQuestion()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('admin/questions/create')
                         ->type('Question for Testing', 'topic')
                         ->type('Is This Question One?', 'body')
                         ->press('Add')
                         ->see('Question Added')
                         ->click('Question for Testing')
                         ->see('Written on')
                         ->see('Last Editted on')
                         ->see('by');
        
        $dummy = Question::where('topic', 'Question for Testing')->first();
        $dummy->delete();

        $user->delete();
    }
}
