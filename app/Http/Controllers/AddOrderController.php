<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order_details;
use Illuminate\Support\Facades\DB;
use App\product;
use App\supplier;

class AddOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $uid = session()->get('Active');
        $product = DB::table('suppliers')
        ->join('products', 'suppliers.account_id', '=', 'products.supplierID')
        ->select('products.id', 'products.supplierID', 'suppliers.Supplier_Name','products.product_details', 'products.product_name', 'products.product_price', 'products.product_qty', 'products.Category', 'products.product_image','suppliers.account_id')->get();
        return view('Customer/index', compact($uid, 'product'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'Qty' => 'required|numeric'
        ]);

        $productqty = product::where('supplierID','=',$request->Psupplier)->first();

        if($productqty->product_qty == 0){
            return back()->with('Fail','This product is sold out');
        }else if($productqty->product_qty < $request->Qty){
            return back()->with('Fail', 'Your input is exceed the amount of product quantity.');
        }else{
        $buy = new order_details();
        $buy->sid = $request->Sid;
        $buy->uid = $request->userid;
        $buy->pid = $request->Pid;
        $buy->product_name = $request->Pname;
        $buy->product_qty = $request->Qty;
        $buy->total_price = $request ->Pprice * $request->Qty;
        $buy->product_photo = $request->Pimage;
        $query = $buy->save();

        if($query){
            product::where('supplierID','=',$request->Psupplier)->decrement('product_qty', $request->Qty);
            $active = session()->get('Active');
            return redirect()->route('AddOrder.show',compact('active'));
        }
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = order_details::where('uid','=',$id)->get();
        return view('Customer/confirmproduct',compact('product','id'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Delete = order_details::where('uid', '=', $id)->first();
        $Delete->delete();
        return redirect()->route('AddOrder.create');
    }
}
