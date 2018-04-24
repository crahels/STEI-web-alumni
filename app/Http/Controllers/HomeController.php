<?php

namespace App\Http\Controllers;

// Posts
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use \Auth;

// Members
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReverificationEmail;
use App\Member;

// Question and Answer
use App\Question;
use App\Answer;

class HomeController extends Controller
{
    public function index() {
        $isMember = Auth::guard('member')->user() != null;
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;

        if ($isAdmin) {
            $posts = Post::orderBy('created_at','desc')->get(); 
        } else if ($isMember) {
            $posts = Post::where('draft', 0)->orderBy('created_at','desc')->get();
        } else {
            $posts = Post::where('draft', 0)->where('public', 1)->orderBy('created_at','desc')->get();
        }

        $members = Member::orderBy('created_at','desc')->get();

        $questions = Question::orderBy('created_at','desc')->get();
        
        $homedata = [$posts, $members, $questions];
        
        return view('home')->with('homedata', $homedata);
    }


}
