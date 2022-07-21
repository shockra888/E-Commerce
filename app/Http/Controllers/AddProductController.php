<?php

namespace App\Http\Controllers;

use App\product;
use App\supplier;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AddProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('suppliers')
            ->join('products', 'suppliers.account_id', '=', 'products.supplierID')
            ->select('products.supplierID', 'suppliers.Supplier_Name', 'products.product_name', 'products.product_price', 'products.product_qty', 'products.Category', 'products.product_image')->get();
        return view('Admin.products', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Supplier.addProduct');
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
            'ProductName' => 'required',
            'ProductPrice' => 'required',
            'ProductQTY' => 'required',
            'Category' => 'required',
            'ProductIMG' => 'required',
            'ProductDetails' => 'required',
            'id' => 'required'
        ]);

        $id = $request->id;
        $product = new product();
        $product->supplierID = $request->id;
        $product->product_name = $request->ProductName;
        $product->product_price = $request->ProductPrice;
        $product->product_qty = $request->ProductQTY;
        $product->product_details = $request->ProductDetails;
        $product->category = $request->Category;

        if ($request->hasFile('ProductIMG')) {
            $file = $request->file('ProductIMG');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('Assets/ProductImage/', $filename);
            $product->product_image = $filename;
        }

        $query = $product->save();

        if ($query) {
            return redirect()->route('AddProduct.show', compact('id'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $uid = session()->get('Active');
        $product = product::where('supplierID', '=', $uid)->get();
        return view('Supplier.products', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editproduct = product::where('id', '=', $id)->first();
        return view('Supplier.editProduct', compact('editproduct', 'id'));
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
        $this->validate($request, [
            'ProductName' => 'required',
            'ProductPrice' => 'required',
            'ProductQTY' => 'required',
            'Category' => 'required',
            'ProductIMG' => 'required',
        ]);

        $Eproduct = product::where('id', $id)->first();
        $Eproduct->product_name = $request->ProductName;
        $Eproduct->product_price = $request->ProductPrice;
        $Eproduct->product_qty = $request->ProductQTY;
        $Eproduct->Category = $request->Category;

        if ($request->hasFile('ProductIMG')) {
            $file = $request->file('ProductIMG');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('Assets/ProductImage/', $filename);
            $Eproduct->product_image = $filename;
        }

        $query = $Eproduct->save();

        if ($query) {
            return redirect()->route('AddProduct.show', compact('id'));
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
        $Delete = product::where('id', '=', $id)->first();
        $Delete->delete();
        return redirect()->route('AddProduct.show', compact('id'));
    }

    public function delete($id)
    {
        $Delete = product::where('supplierID', '=', $id)->first();
        $Delete->delete();
        return redirect()->route('AddProduct.index');
    }
}
