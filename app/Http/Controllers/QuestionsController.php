<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use \Auth;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // order question by created_at in descending order
        $questions = Question::orderBy('created_at','desc')->paginate(15);

        return view('admin.showquestion')->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addquestion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isMember = Auth::guard('member')->user() != null;
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;

         // if not member and admin then cannot edit this question
        if(!($isMember || $isAdmin))
            return redirect('/');

        $this->validate($request, [
            'topic' => 'required',
            'body' => 'required'
        ]);

        //Add Question
        $question = new Question;
        $question->topic = $request->input('topic');
        $question->body = $request->input('body');
        if ($isAdmin) {
			$question->user_id = Auth::user()->id;
            $question->is_admin = 1;
        } else {
			$question->user_id = Auth::guard('member')->user()->id;
            $question->is_admin = 0;
        }
        $question->save();

        return redirect('/admin/questions')->with('success', 'Question Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        if ($question !== null) {
            return view('admin.showeachquestion')->with('question', $question);
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $isMember = Auth::guard('member')->user() != null;
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;

        // if not member and admin then cannot edit this question
        if(!($isMember || $isAdmin))
            return redirect('/');
        
        $question = Question::find($id);
        $member = Auth::guard('member')->user();

        if ($question !== null) {
            // if admin can edit all kinds of question
            // if not admin can only edit his own question
            if ($isAdmin || ($question->user()->id == $member->id && $question->is_admin == 0)) {
                return view('admin.editquestion')->with('question', $question);
            } else {
                return redirect('/admin/questions')->with('error', 'You can not edit this question.');
            }
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $isMember = Auth::guard('member')->user() != null;
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;

        // if not member and admin then cannot edit this question
        if(!($isMember || $isAdmin))
            return redirect('/');
        
        $this->validate($request, [
            'topic' => 'required',
            'body' => 'required'
        ]);

        $question = Question::find($id);
        $member = Auth::guard('member')->user();

        if ($isAdmin || ($question->user()->id == $member->id && $question->is_admin == 0)) {
            $question->topic = $request->input('topic');
            $question->body = $request->input('body');
            $question->save();
            return redirect('/admin/questions/' . $id)->with('success', 'Question Updated');
        } else {
            return redirect('/admin/questions/' . $id)->with('error', 'You can not edit this question.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isMember = Auth::guard('member')->user() != null;
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;

        // if not member and admin then cannot delete this question
        if(!($isMember || $isAdmin))
            return redirect('/');
        
        $question = Question::find($id);
        $member = Auth::guard('member')->user();

        if ($question !== null) {
            // if admin can delete all kinds of question
            // if not admin can only delete his own question
            if ($isAdmin || ($question->user()->id == $member->id && $question->is_admin == 0)) {
                $question->delete();
                $answer = Answer::where('question_id', $id);
                if ($answer !== null) {
                    $answer->delete();
                }
                return redirect('/admin/questions')->with('error', 'Question Deleted');
            } else {
                return redirect('/admin/questions')->with('error', 'You can not delete this question.');
            }
        } else {
            return abort(404);
        }
    }
}
