<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Question;
use App\User;
use App\Member;
use App\Answer;

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

    /**
     * test pin answer
     *
     * @return void
     */
    /*public function testPinAnswer()
    {
        $user = factory(User::class)->create();
        $question = factory(question::class)->create([
            'user_id' => $user->id
        ]);
        $answer = factory(answer::class)->create([
            'user_id' => $user->id,
            'question_id' => $question->id
        ]);
        
        $response = $this->actingAs($user)
                         ->visit('admin/questions/' . $question->id)
                         ->withHeaders([
                            'X-CSRF-TOKEN' => $user->remember_token,
                         ])
                         ->json('POST', 'admin/answers/pin/' . $answer->id . '/' . $question->id . '/1', ['_token' => $user->remember_token])
                         ->assertResponseStatus(201);
        
        $answer->delete();
        $question->delete();
        $user->delete();
    }*/
}
