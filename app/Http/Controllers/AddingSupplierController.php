<?php

namespace App\Http\Controllers;

use App\AddingSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\supplier;
use App\user;

class AddingSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = DB::table('users')
        ->join('suppliers', 'users.id', '=', 'suppliers.account_id')
        ->select('users.email', 'users.account_type','suppliers.account_id','suppliers.Supplier_Name', 'suppliers.Supplier_Contact', 'suppliers.Supplier_Address', 'suppliers.Gender')->get();
        return view('Admin.suppliers', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.addSupplier');
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
            'username' => 'required|unique:users'
        ]);

        $supplier = new user([
            'email' => $request->Email,
            'password' => Hash::make($request->Password),
            'account_type' => $request->AccountType,
            'username' => $request->username
        ]);
        $query1 = $supplier->save();

        $userid = $supplier->id;

        $user_supplier = new supplier();
        $user_supplier->account_id = $userid;
        $user_supplier->Supplier_Name = $request->Fname;
        $user_supplier->Supplier_Contact = $request->Phonenum;
        $user_supplier->Supplier_Address = $request->Address;
        $user_supplier->Gender = $request->Gender;
        $query2 = $user_supplier->save();

        if ($query2) {
            return redirect('AddSupplier')->with('Success', 'Supplier Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AddingSupplier  $addingSupplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplierprofile = DB::table('users')
        ->join('suppliers', 'users.id', '=', 'suppliers.account_id')
        ->select('users.id', 'users.email', 'suppliers.account_id', 'suppliers.Supplier_Name', 'suppliers.Supplier_Contact', 'suppliers.Supplier_Address', 'suppliers.Gender')
        ->where('suppliers.account_id', '=', $id)->first();
        return view('Supplier.profile', compact('supplierprofile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AddingSupplier  $addingSupplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $editsupplier = supplier::where('account_id', '=', $id)->first();
        return view('Supplier.editSupplier', compact('editsupplier', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AddingSupplier  $addingSupplier
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
        $editsupplier = supplier::where('account_id', '=', $id)->first();
        $editsupplier->Supplier_Address = $request->Address;
        $editsupplier->Supplier_Contact = $request->Phonenum;
        $editsupplier->Supplier_Name = $request->Fname;
        $editsupplier->Gender = $request->Gender;
        $query = $editsupplier->save();

        if ($query) {
            return redirect()->route('AddSupplier.show', compact('id'));
        } else {
            return back()->with('Fail', 'data not added due to error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AddingSupplier  $addingSupplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Delete = user::where('id', '=', $id)->first();
        $Delete->delete();
        return redirect()->route('AddSupplier.index');
    }
}
