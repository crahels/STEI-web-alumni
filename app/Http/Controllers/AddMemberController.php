<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Excel;
use DB;
use App\Member;
use Exception;

class AddMemberController extends Controller
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
        return view('admin.addmember');
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
    public function importCSV(Request $request)
    {
        $array_members = collect();
        if ($request->hasFile('list_members')) {
            try {
                $extension = $request->file('list_members')->getClientOriginalExtension();
                if ($extension === 'csv') {
                    $path = $request->file('list_members')->getRealPath();
                    $data = Excel::load($path, function($reader) {})->get();
                    if (!empty($data)) {
                        foreach ($data as $key=>$value) {
                            $member = Member::create([
                                'nim' => $value->nim,
                                'name' => $value->name,
                                'email' => $value->email,
                                'phone_number' => $value->phone_number,
                                'interest' => 'none', 
                                'company' => 'none',
                            ]);
                            $member->save();
                            
                            $member = Member::where('email', $value->email)->first();
                            $array_members->push($member);
                        }
                    }
                } else {
                    return redirect('/admin/members')->with('error', 'Wrong File Extension');
                }
            } catch (Exception $e) {
                return redirect('/admin/members')->with('error', $e->getMessage());
            }
        } else {
            return redirect('/admin/members')->with('error','No CSV file');
        }

        $members = Member::orderBy('name','asc')->paginate(20);
        return redirect('/admin/members')->with('members', $members)->with('success', 'Members Imported');
    }

    public function importMember(Request $request)
    {
        $this->validate($request, [
            'email' => 
                array(
                    'required',
                    'regex:/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/'),
            'phone_number' => 
                array(
                    'required',
                    'regex:/^[0-9]+$/'),
            'nim' => 
                array(
                    'required',
                    'regex:/^[0-9]+$/'),
            'name' => 'required'
        ]);
        $array_members = collect();
        try {
            $member = Member::create([
                'nim' => $request->input('nim'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'interest' => 'none', 
                'company' => 'none'
            ]);
            $member->save();
    
            $member = Member::where('email', $request->input('email'))->first();
            $array_members->push($member);
        } catch (Exception $e) {
            return redirect('/admin/members')->with('error', $e->getMessage());
        }
        
        $members = Member::orderBy('name','asc')->paginate(20);
        return redirect('/admin/members')->with('members', $members)->with('success', 'Member Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
