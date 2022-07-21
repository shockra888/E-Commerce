<?php

namespace App\Http\Controllers;

use App\AddingCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\customer;
use App\user;

use function Ramsey\Uuid\v1;

class AddingCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = DB::table('users')
        ->join('customers', 'users.id', '=', 'customers.account_id')
        ->select('users.email','users.account_type','customers.account_id','customers.Customer_Name', 'customers.Customer_Contact', 'customers.Customer_Address', 'customers.Gender')->get();
        return view('Admin.customers',compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('signin');
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
             $customer = new user([
                'email' => $request->Email,
                'password' => Hash::make($request->Password),
                'account_type' => $request->AccountType,
                'username' => $request->username
            ]);
            $query1 = $customer->save();

            $userid = $customer->id;


            $customer = new customer();
            $customer->account_id = $userid;
            $customer->Customer_Name = $request->Fname;
            $customer->Customer_Contact = $request->Phonenum;
            $customer->Customer_Address = $request->Address;
            $customer->Gender = $request->Gender;
            $query2 = $customer->save();

            if ($query1&&$query2) {
                return back()->with('Success', 'You have been registered successfully! Please log in and enjoy Shopping');
            } else {
            return back()->with('Fail', 'SQL Error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AddingCustomer  $addingCustomer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customerprofile = DB::table('users')
        ->join('customers', 'users.id', '=', 'customers.account_id')
        ->select('customers.account_id', 'users.email', 'users.account_type', 'customers.Customer_Name', 'customers.Customer_Contact', 'customers.Customer_Address', 'customers.Gender')
        ->where('customers.account_id', '=', $id)->first();
        return view('Customer.profile', compact('customerprofile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AddingCustomer  $addingCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editcustomer = customer::where('account_id', '=', $id)->first();
        return view('Customer.editCustomer', compact('editcustomer', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AddingCustomer  $addingCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'Fname' => 'required',
            'Address' => 'required',
            'Phonenum' => 'required',
            'Gender' => 'required',
        ]);
        $editcustomer = customer::where('account_id', '=', $id)->first();
        $editcustomer -> Customer_Address = $request->Address;
        $editcustomer->Customer_Contact = $request->Phonenum;
        $editcustomer->Customer_Name = $request->Fname;
        $editcustomer->Gender = $request->Gender;
        $query = $editcustomer->save();

        if ($query) {
            return redirect()->route('AddCustomer.show', compact('id'));
        } else {
            return back()->with('Fail', 'data not added due to error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AddingCustomer  $addingCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Delete = user::where('id', '=', $id)->first();
        $Delete->delete();
        return redirect()->route('AddCustomer.index');
    }
}
