<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\order;
use App\customer;
use Carbon\Carbon;

class SetOrderController extends Controller
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
    public function create($id)
    {
        return redirect()->route('SetOrder.show',compact('id',));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)    
    {
        $user = customer::where('account_id','=',$request->userid)->first();
        $buying = new order();
        $buying->customer_name = $user->Customer_Name;
        $buying->customer_address = $user->Customer_Address;
        $buying->Customer_Contact = $user->Customer_Contact;
        $buying->AccntID = $request->userid;
        $buying->sid = $request->Supid;
        $buying->pid = $request->pid;
        $buying->product_name = $request->Pname;
        $buying->product_qty = $request->Pqty;
        $buying->total_price = $request->Tprice;
        $buying->total_pay = $request->Tprice;
        $buying->status =$request->status;
        $buying->date_of_order = Carbon::now();

        $query = $buying->save();

        if ($query) { 
            $id = $request->userid;
            return view('Customer.seeorder', compact('id'));
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
        $order = DB::table('orders')->where('AccntID','=',$id)->get();
        $total = DB::table('orders')->where('AccntID', '=', $id)->get()->sum('total_pay');

            return view('Customer.orders', compact('order', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payedit = order::where('AccntId','=',$id);
        return view('Customer.payment',compact('payedit','id'));
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
        $this->validate($request,[
            'pay' => 'required|numeric'
        ]);
        $amount = DB::table('orders')->where('AccntID', '=', $id)->pluck('total_pay')->sum();
        $total = $amount - $request->pay;

        if($amount < $request->pay){
            return redirect()->route('SetOrder.show', compact('id'))->with('Fail','Payment should not be exceeded to the balance');
        }else{
           DB::table('orders')->where('AccntID', '=', $id)->update(['total_pay' => $total]);

        if($amount==0){
            DB::table('orders')->where('AccntID', '=', $id)->update(['status' => 0]);
            return redirect()->route('SetOrder.show',compact('id'));
        }else{
            return redirect()->route('SetOrder.show',compact('id'));
        }
    }
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