<?php

namespace App\Http\Controllers;

use App\Question;
use App\Answer;
use Illuminate\Http\Request;
use \Auth;

class AnswersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function giveAnswer($question_id)
    {
        $questions = Question::orderBy('created_at','desc')->paginate(15);
        return view('admin.addanswer')->with('questions', $questions)->with('question_id', $question_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

         // if not member and admin then cannot edit this answer
        if(!($isMember || $isAdmin))
            return redirect('/');

        $this->validate($request, [
            'body' => 'required',
        ]);

        $answer = new Answer;
        $answer->question_id = $request->input('question_id');
        $answer->body = $request->input('body');
        $answer->user_id = auth()->user()->id;
        if ($isAdmin) {
            $answer->is_admin = 1;
        } else {
            $answer->is_admin = 0;
        }
        $answer->save();

        return redirect('/admin/questions')->with('success', 'Answer Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $answer = Answer::find($id);
        if ($answer !== null) {
            return view('admin.showeachanswer')->with('answer', $answer);
        } else {
            return abort(404);
        }    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $isMember = Auth::guard('member')->user() != null;
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;

        // if not member and admin then cannot edit this question
        if(!($isMember || $isAdmin))
            return redirect('/');
        
        $answer = Answer::find($id);
        $member = Auth::guard('member')->user();

        if ($answer !== null) {
            // if admin can edit all kinds of answer
            // if not admin can only edit his own answer
            if ($isAdmin || ($answer->user()->id == $member->id && $answer->is_admin == 0)) {
                return view('admin.editanswer')->with('answer', $answer);
            } else {
                return redirect('/admin/questions')->with('error', 'You can not edit this answer.');
            }
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function giveRating($answer_id, $user_id)
    {
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;
        $isMember = Auth::guard('member')->user() != null;

        // if not member and admin then cannot rate this answer
        if(!($isMember || $isAdmin))
            return redirect('/');
        
        $answer = Answer::where('id', $answer_id)->first();
        // admin can give vote as much as he can
        if ($isAdmin) {
            $answer->rating++;
            $answer->save();
            
            $questions = Question::orderBy('created_at','desc')->paginate(15);
            return redirect('/admin/questions')->with('questions', $questions)->with('success','Rating Added');
        // member can only give vote once
        } else {
            $found = 0;
            foreach ($answer->users as $user) {
                if ($user->id == $user_id) {
                    $found = 1;
                    break;
                }
            }

            if ($found == 0) {
                $answer->users()->attach($user_id);

                $answer->rating++;
                $answer->save();
                
                $questions = Question::orderBy('created_at','desc')->paginate(15);
                return redirect('/admin/questions')->with('questions', $questions)->with('success','Rating Added');
            } else {
                $answer->users()->detach($user_id);

                $answer->rating--;
                $answer->save();
                
                $questions = Question::orderBy('created_at','desc')->paginate(15);
                return redirect('/admin/questions')->with('questions', $questions)->with('error','Rating Deleted');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
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
            'body' => 'required',
        ]);

        $answer = Answer::find($id);
        $member = Auth::guard('member')->user();

        if ($isAdmin || ($answer->user()->id == $member->id && $answer->is_admin == 0)) {
            $answer->body = $request->input('body');
            $answer->save();
            return redirect('/admin/questions')->with('success', 'Answer Updated');
        } else {
            return redirect('/admin/questions')->with('error', 'You can not edit this answer.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isMember = Auth::guard('member')->user() != null;
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;

        // if not member and admin then cannot delete this answer
        if(!($isMember || $isAdmin))
            return redirect('/');
        
        $answer = Answer::find($id);
        $member = Auth::guard('member')->user();

        if ($answer !== null) {
            // if admin can delete all kinds of answer
            // if not admin can only delete his own answer
            if ($isAdmin || ($answer->user()->id == $member->id && $answer->is_admin == 0)) {
                $answer->delete();
                return redirect('/admin/questions')->with('error', 'Answer Deleted');
            } else {
                return redirect('/admin/questions')->with('error', 'You can not delete this answer.');
            }
        } else {
            return abort(404);
        }
    }
}
