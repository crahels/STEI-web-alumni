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
        $isMember = Auth::guard('member')->user() != null;
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;

         // if not member and admin then cannot edit this question
        if(!($isMember || $isAdmin))
            return redirect('/');
        
        $questions = Question::orderBy('created_at','desc')->paginate(15);
        if ($isAdmin) {
            return view('admin.addanswer')->with('questions', $questions)->with('question_id', $question_id);
        } else {
            return view('users.qna.addanswer')->with('questions', $questions)->with('question_id', $question_id);
        }
        
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
    public function store(Request $request, $each)
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
        if ($isAdmin) {
            $answer->user_id = Auth::user()->id;
            $answer->is_admin = 1;
        } else {
            $answer->user_id = Auth::guard('member')->user()->id;
            $answer->is_admin = 0;
        }
        $answer->save();

        if ($isAdmin) {
            if ($each == 1) {
                return redirect('/admin/questions/' . $request->input('question_id'))->with('success', 'Answer Saved');
            } else {
                return redirect('/admin/questions')->with('success', 'Answer Saved');
            }
        } else {
            return redirect('/questions')->with('success', 'Answer Saved');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAjax(Request $request)
    {
        $isMember = Auth::guard('member')->user() != null;
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;

         // if not member and admin then cannot edit this answer
        //if(!($isMember || $isAdmin))
        //    return response()->json([], 404);

        $this->validate($request, [
            'body' => 'required',
        ]);

        $answer = new Answer;
        $answer->question_id = $request->question_id;
        $answer->body = $request->body;
        $answer->user_id = auth()->user()->id;
        if ($isAdmin) {
            $answer->user_id = Auth::user()->id;
            $answer->is_admin = 1;
        } else {
            $answer->user_id =  Auth::guard('member')->user()->id;
            $answer->is_admin = 0;
        }
        $answer->save();
        
        return response()->json([
            'status' => 'Job Done'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $isMember = Auth::guard('member')->user() != null;
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;

         // if not member and admin then cannot edit this answer
        if(!($isMember || $isAdmin))
            return redirect('/');

        $answer = Answer::find($id);
        if ($answer !== null) {
            if ($isAdmin) {
                return view('admin.showeachanswer')->with('answer', $answer);
            } else {
                return view('users.qna.showeachanswer')->with('answer', $answer);
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
            if ($isAdmin || ($answer->user->id == $member->id && $answer->is_admin == 0)) {
                if ($isAdmin) {
                    return view('admin.editanswer')->with('answer', $answer);
                } else {
                    return view('users.qna.editanswer')->with('answer', $answer);
                }
            } else {
                return redirect('/')->with('error', 'You can not edit this answer.');
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
            $answer->timestamps = false;
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
                $answer->timestamps = false;
                $answer->save();
                
                $questions = Question::orderBy('created_at','desc')->paginate(15);
                return redirect('/questions')->with('questions', $questions)->with('success','Rating Added');
            } else {
                $answer->users()->detach($user_id);

                $answer->rating--;
                $answer->timestamps = false;
                $answer->save();
                
                $questions = Question::orderBy('created_at','desc')->paginate(15);
                return redirect('/questions')->with('questions', $questions)->with('error','Rating Deleted');
            }
        }
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function givePin($answer_id, $question_id, $each)
    {
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;

        // if not admin then cannot pin this answer
        if(!$isAdmin)
            return redirect('/');
        
        $answer = Answer::where('id', $answer_id)->first();
        // admin can give vote as much as he can
        if ($isAdmin) {
            if ($answer->is_pinned == 0) {
                $answer_pinned = Answer::where(['is_pinned' => 1, 'question_id' => $question_id])->first();
                if ($answer_pinned !== null) {
                    $answer_pinned->is_pinned = 0;
                    $answer_pinned->timestamps = false;
                    $answer_pinned->save();
                }
                $answer->is_pinned = 1;
                $answer->timestamps = false;
                $answer->save();

                $questions = Question::orderBy('created_at','desc')->paginate(15);
                if ($each == 1) {
                    return redirect('/admin/questions/' . $answer->question->id)->with('success','Answer Pinned');
                } else {
                    return redirect('/admin/questions')->with('questions', $questions)->with('success','Answer Pinned');
                }
            } else {
                $answer->is_pinned = 0;
                $answer->timestamps = false;
                $answer->save();

                $questions = Question::orderBy('created_at','desc')->paginate(15);
                if ($each == 1) {
                    return redirect('/admin/questions/' . $answer->question->id)->with('error','Answer Unpinned');
                } else {
                    return redirect('/admin/questions')->with('questions', $questions)->with('error','Answer Unpinned');
                }
            }
        // others besides admin can not give vote
        } else {
            $questions = Question::orderBy('created_at','desc')->paginate(15);
            return redirect('/admin/questions')->with('questions', $questions)->with('error','You do not have right to pin this answer.');
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

        if ($isAdmin || ($answer->user->id == $member->id && $answer->is_admin == 0)) {
            if ($request->input('pin') === 'yes') {
                $answer_pinned = Answer::where(['is_pinned' => 1, 'question_id' => $answer->question->id])->first();
                if ($answer_pinned !== null) {
                    $answer_pinned->is_pinned = 0;
                    $answer_pinned->timestamps = false;
                    $answer_pinned->save();
                }
                $answer->is_pinned = 1;
            } else {
                $answer->is_pinned = 0;
            }
            $answer->body = $request->input('body');
            $answer->save();
            if ($isAdmin) {
                return redirect('/admin/answers/' . $id)->with('success', 'Answer Updated');
            } else {
                return redirect('/answers/' . $id)->with('success', 'Answer Updated');
            }
        } else {
            return redirect('/')->with('error', 'You can not edit this answer.');
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
            if ($isAdmin || ($answer->user->id == $member->id && $answer->is_admin == 0)) {
                $answer->delete();
                if ($isAdmin) {
                    return redirect('/admin/questions')->with('error', 'Answer Deleted');
                } else {
                    return redirect('/questions')->with('error', 'Answer Deleted');
                }
            } else {
                return redirect('/')->with('error', 'You can not delete this answer.');
            }
        } else {
            return abort(404);
        }
    }
}