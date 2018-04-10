<?php

namespace App\Http\Controllers;

use App\Question;
use App\Answer;
use Illuminate\Http\Request;

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
        return view('users.addanswer')->with('questions', $questions)->with('question_id', $question_id);
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
        $this->validate($request, [
            'body' => 'required',
        ]);

        $answer = new Answer;
        $answer->question_id = $request->input('question_id');
        $answer->body = $request->input('body');
        $answer->user_id = auth()->user()->id;
        $answer->save();

        return redirect('/questions')->with('success', 'Answer Saved');
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
        $answer = Answer::find($id);
        if ($answer !== null) {
            return view('users.editanswer')->with('answer', $answer);
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
    public function giveRating($answer_id)
    {
        $answer = Answer::where('id', $answer_id)->first();
        $answer->rating++;
        $answer->save();

        $questions = Question::orderBy('created_at','desc')->paginate(15);
        return redirect('/questions')->with('questions', $questions)->with('success','Rating Added');
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
        $this->validate($request, [
            'body' => 'required',
        ]);

        $answer = Answer::find($id);
        $answer->body = $request->input('body');
        $answer->save();

        return redirect('/questions')->with('success', 'Answer Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = Answer::find($id);
        $answer->delete();

        return redirect('/questions')->with('error', 'Answer Deleted');
    }
}
