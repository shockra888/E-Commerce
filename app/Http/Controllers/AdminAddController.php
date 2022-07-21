<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\admin;

class AdminAddController extends Controller
{
    function Create(Request $request)
    {

        $this->validate($request, [
            'Fname' => 'required',
            'Address' => 'required',
            'Phonenum' => 'required',
            'Gender' => 'required',
            'Email' => 'required|email|unique:admins',
            'Password' => 'required|min:5|max:12'
        ]);

        $user_admin = new admin();
        $user_admin->Admin_Name = $request->Fname;
        $user_admin->Admin_Contact = $request->Phonenum;
        $user_admin->Admin_Address = $request->Address;
        $user_admin->email = $request->Email;
        $user_admin->password = Hash::make($request->Password);
        $user_admin->Gender = $request->Gender;
        $query2 = $user_admin->save();

        if ($query2) {
            return back()->with('Success', 'You have been registered successfully! Please log in and enjoy Shopping');
        }
    }
}
