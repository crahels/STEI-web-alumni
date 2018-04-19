<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use \Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;
        $isMember = Auth::guard('member')->user() != null;
        if ($isAdmin){
            return view('admin.showpost')->with('posts', $posts);
        }
            
        else if ($isMember){
            $posts = Post::where('draft','=', '0')->paginate(10);
            return view('article')->with('posts', $posts);
        }
        else { //guest
            $posts = Post::where('draft','=', '0')->paginate(10);
            $posts = Post::where('public','=', '1')->paginate(10);
            return view('article')->with('posts', $posts);
        }
            
    }

    public function indexMember()
    {
        $posts = Post::orderBy('created_at','desc')->get();
        return view('home')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createpost');
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
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        $public = '0';
        $draft = '0';
        if ($request->input('draft') === 'yes') {
            $draft = '1';
        } 

        if ($request->input('public') === 'yes') {
            $public = '1';
        }

        if ($request->hasFile('cover_image')) {
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);            
        } else {
            $filenameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->draft = $draft;
        $post->public = $public;
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filenameToStore;
        $post->save();

        return redirect('/admin/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;
        $isMember = Auth::guard('member')->user() != null;
       
        if ($post !== null) {
            if ($isAdmin)
                return view('admin.showeachpost')->with('post', $post);
            else
                return view('showarticle')->with('post', $post);
           
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
        $post = Post::find($id);
        if ($post !== null) {
            return view('admin.editpost')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        
        $public = '0';
        $draft = '0';
        if ($request->input('draft') === 'yes') {
            $draft = '1';
        } 

        if ($request->input('public') === 'yes') {
            $public = '1';
        }

        if ($request->hasFile('cover_image')) {
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);            
        } 

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->draft = $draft;
        $post->public = $public;
        if ($request->hasFile('cover_image')) {
            if($post->cover_image !== 'noimage.jpg'){
                Storage::delete('public/cover_images/' . $post->cover_image);
            }
            $post->cover_image = $filenameToStore;
        }
        $post->save();

        return redirect('/admin/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        if ($post->cover_image !== 'noimage.jpg') {
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        return redirect('/admin/posts')->with('error', 'Post Deleted');
    }
}
