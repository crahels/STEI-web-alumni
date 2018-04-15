<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReverificationEmail;
use App\Member;
use \Auth;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['show', 'edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::orderBy('nim','asc')->paginate(20);
        return view('members.list')->with('members', $members);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Member::find($id);
        if($user !== null){
            return view('admin.profile')->with('user', $user);
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
        $isMember = Auth::guard('member')->user() != null && Auth::guard('member')->user()->id == $id;
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;
        $user = Member::find($id);
        if($user !== null && ($isMember || $isAdmin)){
            return view('admin.editprofile')->with('user', $user);
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
        $isMember = Auth::guard('member')->user() != null && Auth::guard('member')->user()->id == $id;
        $isAdmin = Auth::user() != null && Auth::user()->IsAdmin == 1;

        if(!($isMember || $isAdmin))
            return redirect('/');
        
        $this->validate($request, [
            //'email' => 
            //    array(
            //        'required',
            //        'regex:/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/'),
            'phone_number' => 
                array(
                    'required',
                    'regex:/^[0-9]+$/'),
            'company' => 'required',
            'interest' => 'required',
            'profile_image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('profile_image')){
            $fileNameWithExt = $request->file('profile_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            $path = $request->file('profile_image')->storeAs('public/profile_image', $fileNameToStore);
        }

        $user = Member::find($id);
        //$user->temp_email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->company = $request->input('company');
        $user->interest = $request->input('interest');
        $user->address = $request->input('address');
        if($request->hasFile('profile_image')){
            if($user->profile_image !== 'noimage.jpg'){
                Storage::delete('public/profile_image/' . $user->profile_image);
            }
            $user->profile_image = $fileNameToStore;
        }
        $user->save();

        /*if($user->email != $user->temp_email){
            $provider = $user->accounts()->where('provider_name','=','google')->first();
            if($user->verifyToken != null)
                $user->verifyToken->delete();

            if($provider != null)
                $provider->delete();
            
            $token = $user->verifyToken()->create([
                'token' => sha1(time())
            ]);
            Mail::to($user)->send(new SendReverificationEmail($token));
            return redirect('/members/' . $id)->with('success', 'Profile Updated. Confirmation code has been sent to new email.');
        }else{*/
            return redirect('/admin/members/' . $id)->with('success', 'Profile Updated');
        //}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Member::find($id);
        if($user !== null) {
            $user->delete();
            return redirect('/admin/members')->with('error', 'Member Deleted');
        } else {
            return abort(404);
        }
    }
}
