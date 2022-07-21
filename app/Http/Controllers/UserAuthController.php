<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\user;
use App\product;
use App\order;

class UserAuthController extends Controller
{

    function check(Request $request){
        $this->validate($request,[
            'username' => 'required',
            'Password' => 'required',
        ]);
            $Ucount = user::count();
            $ocount = order::count();
            $sales = DB::table('orders')->get()->sum('total_price');
        $psales = DB::table('orders')->take(5)->get();

        $product = DB::table('suppliers')
        ->join('products', 'suppliers.account_id', '=', 'products.supplierID')
        ->select('products.id','products.supplierID', 'suppliers.Supplier_Name', 'products.product_name', 'products.product_price', 'products.product_qty', 'products.Category','products.product_details', 'products.product_image')->take(5)->get();

        $user = user::where('username', '=', $request->username)->first();
        if(!$user){
            return back()->with('Fail', 'Account not found');
        }else if($user->account_type == 'Admin'){
            if(Hash::check($request->Password, $user->password)){
                $request->session()->put('Active', $user->id);
                return view('Admin.index',compact($user->id,'Ucount','user','product','ocount','sales','psales'));
            }else{
                return back()->with('Fail','Incorrect Password');
            }
        }else if($user->account_type == 'Customer'){
            if (Hash::check($request->Password, $user->password)) {
                $request->session()->put('Active', $user->id);
                return redirect()->route('AddOrder.create');
            }else{
                return back()->with('Fail', 'Incorrect Password');
            }
        }else if($user->account_type == 'Supplier'){
            if (Hash::check($request->Password, $user->password)) {
                $request->session()->put('Active', $user->id);
                $psales = DB::table('orders')->where('sid', '=', $user->id)->get()->sum('total_price');
                $osales = DB::table('orders')->where('sid','=',$user->id)->get();
                $pcount = product::where('supplierID','=',$user->id)->count();
                $product = product::where('supplierID', '=', $user->id)->take(5)->get();
                return view('Supplier.index', compact($user->id,'user','product','pcount','psales','osales'));
            } else {
                return back()->with('Fail', 'Incorrect Password');
            }
        }
    }
    function Adminhome(){
        if(session()->has('Active')){
            $user = user::where('id');
            return view('Admin.index',compact($user->id));
        }else{
            return redirect('Login');
        }
    }

    function Supplierhome(){
        if (session()->has('Active')) {
            $user = DB::table('users')->first();
            return view('Supplier.index',compact($user->id));
        } else {
            return redirect('Login');
        }
    }

    function logout(){
        if (session()->has('Active')) {
            session()->pull('Active');
            return redirect('/');
        }
    }
}
