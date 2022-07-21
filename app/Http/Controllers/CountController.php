<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\product;
use App\order;
use Illuminate\Support\Facades\DB;

class CountController extends Controller
{
    //
    function userCount(){
        $Ucount = user::count();
        $ocount = order::count();
        $sales = DB::table('orders')->get()->sum('total_price');
        $psales = DB::table('orders')->get()->take(5);

        $product = DB::table('suppliers')
        ->join('products', 'suppliers.account_id', '=', 'products.supplierID')
        ->select('products.supplierID', 'suppliers.Supplier_Name', 'products.product_name', 'products.product_price','products.product_details','products.product_qty', 'products.Category', 'products.product_image')->take(5)->get();

        return view('Admin/index',compact('Ucount','product','ocount','sales','psales'));
    }

    function products(){
        $user = session()->get('Active');
        $psales = DB::table('orders')->where('sid', '=', $user)->get()->sum('total_price');
        $osales = DB::table('orders')->where('sid', '=', $user)->get();
        $product = product::where('supplierID', '=', $user)->take(5)->get();
        $pcount = product::where('supplierID', '=', $user)->count();
        return view('Supplier/index', compact($user, 'product','pcount','psales','osales'));
    }

    function Showsales(){
        $sales = DB::table('orders')->get();
        return view('Admin.sales',compact('sales'));
    }

    function Suppsales(){
        $user = session()->get('Active');
        $osales = DB::table('orders')->where('sid', '=', $user)->get();
        return view('Supplier.sales',compact('osales'));
    }
}
