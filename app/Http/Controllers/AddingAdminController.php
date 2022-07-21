<?php

namespace App\Http\Controllers;

use App\AddingAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\admin;
use App\user;
class AddingAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.addAdmin');
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
            'Fname' => 'required',
            'Address' => 'required',
            'Phonenum' => 'required',
            'Gender' => 'required',
            'Email' => 'required|email',
            'Password' => 'required|min:5|max:12',
            'AccountType' => 'required',
            'username' => 'required|unique:users'
        ]);

        $admin = new user([
            'email' => $request->Email,
            'password' => Hash::make($request->Password),
            'account_type' => $request->AccountType,
            'username' =>$request->username
        ]);
        $query1 = $admin->save();

        $userid = $admin->id;


        $user_admin = new admin();
        $user_admin->Admin_Name = $request->Fname;
        $user_admin->account_id = $userid;
        $user_admin->Admin_Contact = $request->Phonenum;
        $user_admin->Admin_Address = $request->Address;
        $user_admin->Gender = $request->Gender;
        $query2 = $user_admin->save();

        if ($query1&&$query2) {
            return back()->with('Success', 'You have been registered successfully! Please log in and enjoy Shopping');
        }else{
            return back()->with('Fail', 'SQL Error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\users
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adminprofile = DB::table('users')
        ->join('admins', 'users.id', '=', 'admins.account_id')
        ->select('admins.account_id','users.email', 'users.account_type', 'admins.Admin_Name', 'admins.Admin_Contact', 'admins.Admin_Address', 'admins.Gender')
        ->where('admins.account_id','=',$id)->first();
        return view('Admin.profile',compact('adminprofile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AddingAdmin  $addingAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request, $id)
    {
        $editadmin = admin::where('account_id', '=',$id)->first();
        return view('Admin.editAdmin',compact('editadmin','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AddingAdmin  $addingAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Fname' => 'required',
            'Address' => 'required',
            'Phonenum' => 'required',
            'Gender' => 'required',
        ]);
        $editadmin = admin::where('account_id', '=', $id)->first();
        $editadmin->Admin_Address = $request->Address;
        $editadmin->Admin_Contact = $request->Phonenum;
        $editadmin->Admin_Name = $request->Fname;
        $editadmin->Gender = $request->Gender;
        $query = $editadmin->save();

        if($query){
            return redirect()->route('AddAdmin.show',compact('id'));
        }else{
            return back()->with('Fail', 'data not added due to error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AddingAdmin  $addingAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddingAdmin $addingAdmin)
    {
        //
    }
}
