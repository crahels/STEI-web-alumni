<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getAdminPost() {
        return view('admin.showpost')->with('posts', $posts);
    }

    public function getMemberPost() {
        return view('home')->with('posts', $posts);
    }
}
