<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Question;
use App\User;
use App\Member;
use App\Answer;
use \Auth;

class QuestionAnswerTest extends TestCase
{
    /**
     * test add question
     *
     * @return void
     */
    public function testAddQuestionAdminSuccess()
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
    public function testAddQuestionAdminWithoutTopic()
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
    public function testAddQuestionAdminWithoutBody()
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
    public function testAddQuestionAdminWithoutBodyTopic()
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
    public function testShowQuestionAdmin()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->visit('admin/questions/create')
                         ->type('Question for Testing', 'topic')
                         ->type('Is This Question One?', 'body')
                         ->press('Add')
                         ->see('Question Added');
        
        $dummy = Question::where('topic', 'Question for Testing')->first();
        $written_on = 'Written on ' . $dummy->created_at->format('d M Y');
        $response = $this->actingAs($user)
                         ->visit('admin/questions')
                         ->click($written_on)
                         ->see('Written on')
                         ->see('Last Editted on')
                         ->see('by');
        
        $dummy->delete();
        $user->delete();
    }

    /**
     * test edit question
     *
     * @return void
     */
    public function testEditQuestionAdminSuccess()
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
    public function testEditQuestionAdminWithoutTopic()
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
    public function testEditQuestionAdminWithoutBody()
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
    public function testEditQuestionAdminWithoutBodyTopic()
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
    public function testShowAnswerAdmin()
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
    public function testEditAnswerPinAdmin()
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
    public function testEditAnswerUnpinnedAdmin()
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
    public function testEditAnswerAdminWithoutBody()
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

    /**
     * test show question
     *
     * @return void
     */
    public function testShowEditQuestion()
    {
        $member = factory(Member::class)->create();

        $question = factory(question::class)->create([
            'is_admin' => 0,
            'member_id' => $member->id
        ]);
        
        Auth::guard('member')->login($member);
        $response = $this->visit('/questions')
                         ->click($question->topic)
                         ->seePageIs('questions/' . $question->id)
                         ->click('Edit')
                         ->seePageIs('questions/' . $question->id . '/edit')
                         ->type($question->topic . ' Editted', 'topic')
                         ->type($question->body . ' Editted', 'body')
                         ->check('anon')
                         ->press('Submit')
                         ->seePageIs('questions/' . $question->id)
                         ->see($question->topic . ' Editted')
                         ->see($question->body . ' Editted');
        
        $question->delete();
        $member->delete();
    }

    public function testAddQuestionAnon()
    {
        $member = factory(Member::class)->create();
        $question = factory(question::class)->make();

        Auth::guard('member')->login($member);
        $response = $this->visit('/questions/create')
                         ->type($question->body, 'body')
                         ->type($question->topic, 'topic')
                         ->check('anon')
                         ->press('Submit')
                         ->seePageIs('/questions')
                         ->see('by Anonymous');
        
        $dummy = Question::where('body', $question->body)->first();
        $dummy->delete();
        $member->delete();
    }

    /**
     * test show question
     *
     * @return void
     */
    public function testShowEditQuestionOthers()
    {
        $member = factory(Member::class)->create();
        $member_dummy = factory(Member::class)->create();

        $question = factory(question::class)->create([
            'is_admin' => 0,
            'member_id' => $member_dummy->id
        ]);
        
        Auth::guard('member')->login($member);
        $response = $this->visit('questions')
                         ->click($question->topic)
                         ->seePageIs('questions/' . $question->id)
                         ->dontSee('Delete');
        
        $response = $this->visit('questions/' . $question->id . '/edit')
                         ->seePageIs('/');

        $question->delete();
        $member->delete();
        $member_dummy->delete();
    }

    /**
     * test show question edit
     *
     * @return void
     */
    public function testShowQuestionVoteAnswer()
    {
        $user = factory(User::class)->create();
        $member = factory(Member::class)->create();

        $question = factory(question::class)->create([
            'user_id' => $user->id
        ]);
        $answer = factory(answer::class)->create([
            'is_admin' => 0,
            'member_id' => $member->id,
            'question_id' => $question->id
        ]);
        
        Auth::guard('member')->login($member);
        $response = $this->visit('questions')
                         ->click($question->topic)
                         ->seePageIs('questions/' . $question->id)
                         ->see($answer->body)
                         ->press('VOTE')
                         ->seePageIs('questions/' . $question->id)
                         ->see('VOTED')
                         ->see('1');
        
        $answer->delete();
        $question->delete();
        $user->delete();
        $member->delete();
    }

    /**
     * test show question vote
     *
     * @return void
     */
    public function testShowQuestionVoteUnvote()
    {
        $user = factory(User::class)->create();
        $member = factory(Member::class)->create();

        $question = factory(question::class)->create([
            'user_id' => $user->id
        ]);
        $answer = factory(answer::class)->create([
            'is_admin' => 0,
            'member_id' => $member->id,
            'question_id' => $question->id
        ]);
        
        Auth::guard('member')->login($member);
        $response = $this->visit('questions')
                         ->click($question->topic)
                         ->seePageIs('questions/' . $question->id)
                         ->see($answer->body)
                         ->press('VOTE')
                         ->seePageIs('questions/' . $question->id)
                         ->see('VOTED')
                         ->see('1')
                         ->press('VOTED')
                         ->seePageIs('questions/' . $question->id)
                         ->see('VOTE')
                         ->see('0');
        
        $answer->delete();
        $question->delete();
        $user->delete();
        $member->delete();
    }

    /**
     * test show question add answer
     *
     * @return void
     */
    public function testShowQuestionAddAnswer()
    {
        $user = factory(User::class)->create();
        $member = factory(Member::class)->create();

        $question = factory(question::class)->create([
            'user_id' => $user->id
        ]);
            
        $answer = factory(answer::class)->make();
        
        Auth::guard('member')->login($member);
        $response = $this->visit('questions')
                         ->click($question->topic)
                         ->seePageIs('questions/' . $question->id)
                         ->type($answer->body, 'body')
                         ->press('Submit')
                         ->seePageIs('questions/' . $question->id)
                         ->see($answer->body);
        
        $dummy = Answer::where('body', $answer->body)->first();
        $dummy->delete();
        $question->delete();
        $user->delete();
        $member->delete();
    }

    /**
     * test show answer
     *
     * @return void
     */
    public function testShowEditAnswer()
    {
        $user = factory(User::class)->create();
        $member = factory(Member::class)->create();

        $question = factory(question::class)->create([
            'user_id' => $user->id
        ]);
        $answer = factory(answer::class)->create([
            'is_admin' => 0,
            'member_id' => $member->id,
            'question_id' => $question->id
        ]);
        
        Auth::guard('member')->login($member);
        $response = $this->visit('answers/' . $answer->id)
                         ->click('Edit')
                         ->seePageIs('answers/' . $answer->id . '/edit')
                         ->see($question->body)
                         ->type($answer->body . ' Editted', 'body')
                         ->press('Submit')
                         ->seePageIs('answers/' . $answer->id)
                         ->see($question->topic)
                         ->see($question->body)
                         ->see($answer->body . ' Editted');
        
        $answer->delete();
        $question->delete();
        $user->delete();
        $member->delete();
    }

    /**
     * test show question
     *
     * @return void
     */
    public function testShowEditAnswerOthers()
    {
        $member = factory(Member::class)->create();
        $member_dummy = factory(Member::class)->create();

        $question = factory(question::class)->create([
            'member_id' => $member->id,
            'is_admin' => 0
        ]);

        $answer = factory(answer::class)->create([
            'is_admin' => 0,
            'member_id' => $member_dummy->id,
            'question_id' => $question->id
        ]);
        
        Auth::guard('member')->login($member);
        $response = $this->visit('answers/' . $answer->id)
                         ->dontSee('Delete');
        
        $response = $this->visit('answers/' . $answer->id . '/edit')
                         ->seePageIs('/');
        
        $answer->delete();
        $question->delete();
        $member->delete();
        $member_dummy->delete();
    }
    
}
