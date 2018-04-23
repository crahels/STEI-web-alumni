<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Question;
use App\User;
use App\Member;
use App\Answer;

class QuestionAnswerTest extends TestCase
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
     * test edit question
     *
     * @return void
     */
    public function testEditQuestionSuccess()
    {
        $user = factory(User::class)->create();
        $question = factory(question::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)
                         ->visit('admin/questions/' . $question->id)
                         ->click('Edit')
                         ->seePageIs('admin/questions/' . $question->id . '/edit')
                         ->type($question->topic . ' Editted', 'topic')
                         ->type($question->body . ' Editted', 'body')
                         ->press('Submit')
                         ->seePageIs('admin/questions/' . $question->id)
                         ->see('Question Updated');
                         
        $question->delete();
        $user->delete();
    }

    /**
     * test edit question
     *
     * @return void
     */
    public function testEditQuestionWithoutTopic()
    {
        $user = factory(User::class)->create();
        $question = factory(question::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)
                         ->visit('admin/questions/' . $question->id)
                         ->click('Edit')
                         ->seePageIs('admin/questions/' . $question->id . '/edit')
                         ->type('', 'topic')
                         ->type($question->body . ' Editted', 'body')
                         ->press('Submit')
                         ->see('The topic field is required.');
                         
        $question->delete();
        $user->delete();
    }

    /**
     * test edit question
     *
     * @return void
     */
    public function testEditQuestionWithoutBody()
    {
        $user = factory(User::class)->create();
        $question = factory(question::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)
                         ->visit('admin/questions/' . $question->id)
                         ->click('Edit')
                         ->seePageIs('admin/questions/' . $question->id . '/edit')
                         ->type($question->topic . ' Editted', 'topic')
                         ->type('', 'body')
                         ->press('Submit')
                         ->see('The body field is required.');
                         
        $question->delete();
        $user->delete();
    }

    /**
     * test edit question
     *
     * @return void
     */
    public function testEditQuestionWithoutBodyTopic()
    {
        $user = factory(User::class)->create();
        $question = factory(question::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)
                         ->visit('admin/questions/' . $question->id)
                         ->click('Edit')
                         ->seePageIs('admin/questions/' . $question->id . '/edit')
                         ->type('', 'topic')
                         ->type('', 'body')
                         ->press('Submit')
                         ->see('The topic field is required.')
                         ->see('The body field is required.');
                         
        $question->delete();
        $user->delete();
    }

    /**
     * test show answer
     *
     * @return void
     */
    public function testShowAnswer()
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
                         ->visit('admin/answers/' . $answer->id)
                         ->see($question->body)
                         ->see($answer->body);
        
        $answer->delete();
        $question->delete();
        $user->delete();
    }

    /**
     * test edit answer
     *
     * @return void
     */
    public function testEditAnswerPin()
    {
        $user = factory(User::class)->create();
        $question = factory(question::class)->create([
            'user_id' => $user->id
        ]);
        $answer = factory(answer::class)->create([
            'user_id' => $user->id,
            'question_id' => $question->id
        ]);

        $answer_second = factory(answer::class)->create([
            'user_id' => $user->id,
            'question_id' => $question->id,
            'is_pinned' => 1
        ]);
        
        $this->seeInDatabase('answers', ['question_id' => $question->id, 'id' => $answer_second->id, 'is_pinned' => 1]);

        $response = $this->actingAs($user)
                         ->visit('admin/answers/' . $answer->id)
                         ->click('Edit')
                         ->see($question->body)
                         ->see($answer->body)
                         ->type('Answer for Testing Editted', 'body')
                         ->check('pin')
                         ->press('Submit')
                         ->visit('admin/answers/' . $answer->id)
                         ->see('PINNED');
        
        $this->seeInDatabase('answers', ['question_id' => $question->id, 'id' => $answer_second->id, 'is_pinned' => 0]);
        $this->seeInDatabase('answers', ['question_id' => $question->id, 'id' => $answer->id, 'is_pinned' => 1]);

        $answer->delete();
        $answer_second->delete();
        $question->delete();
        $user->delete();
    }

    /**
     * test edit answer
     *
     * @return void
     */
    public function testEditAnswerUnpinned()
    {
        $user = factory(User::class)->create();
        $question = factory(question::class)->create([
            'user_id' => $user->id
        ]);

        $answer = factory(answer::class)->create([
            'user_id' => $user->id,
            'question_id' => $question->id,
            'is_pinned' => 1
        ]);

        $answer_second = factory(answer::class)->create([
            'user_id' => $user->id,
            'question_id' => $question->id,
            'is_pinned' => 0
        ]);

        $response = $this->actingAs($user)
                         ->visit('admin/answers/' . $answer->id)
                         ->click('Edit')
                         ->see($question->body)
                         ->see($answer->body)
                         ->type('Answer for Testing Editted', 'body')
                         ->uncheck('pin')
                         ->press('Submit')
                         ->visit('admin/answers/' . $answer->id)
                         ->see('NOT PINNED');
        
        $this->seeInDatabase('answers', ['question_id' => $question->id, 'id' => $answer_second->id, 'is_pinned' => 0]);
        $this->seeInDatabase('answers', ['question_id' => $question->id, 'id' => $answer->id, 'is_pinned' => 0]);

        $answer->delete();
        $answer_second->delete();
        $question->delete();
        $user->delete();
    }

    /**
     * test edit answer
     *
     * @return void
     */
    public function testEditAnswerWithoutBody()
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
                         ->visit('admin/answers/' . $answer->id)
                         ->click('Edit')
                         ->see($question->body)
                         ->see($answer->body)
                         ->type('', 'body')
                         ->check('pin')
                         ->press('Submit')
                         ->see('The body field is required.');
        
        $answer->delete();
        $question->delete();
        $user->delete();
    }
}
