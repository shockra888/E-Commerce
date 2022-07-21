<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\product;
use App\order;
use Illuminate\Support\Arr;

class SearchController extends Controller
{
    function SearchAction(Request $request){
        $query = $request->get('query');
        $uid = session()->get('Active');
        $product = DB::table('products')
        ->join('suppliers', 'suppliers.account_id', '=', 'products.supplierID')
        ->select('products.id', 'products.supplierID', 'suppliers.Supplier_Name', 'products.product_details', 'products.product_name', 'products.product_price', 'products.product_qty', 'products.Category', 'products.product_image', 'suppliers.account_id')->where('product_name', 'like', '%'.$query.'%')->orWhere('Category', 'like', '%' . $query . '%')
            ->get();
            return view('Customer/index',compact('product',$uid));
    }

    function SearchOrder(Request $request){
        if($request->ajax()){
            $query = $request->get('query');

            if($query != ''){
                $data = DB::table('orders')->where('product_name', 'like', '%' . $query . '%')->get();
            }else{
                $data = DB::table('orders')->where('AccntID', '=', session()->get('Active'))->get();
            }
            $total_row = $data->count();
            if($total_row>0){
                foreach($data as $row){
                    $output ='
                        <tr>
                            <td>'.\Carbon\Carbon::parse($row->date_of_order)->format('l M/d/Y').'</td>
                            <td>'.$row->product_name.'</td>
                            <td>'.$row->product_qty.'</td>
                            <td>'.$row->total_price.'</td>
                        </tr>
                    ';
                }
            }else{
                $output ='
                <tr>
                    <td align="center" colspan="5">No data found</td>
                </tr>
                ';
            }
            $data =array(
                'table_data' => $output
            );
            echo json_encode($data);
        }
    }

    function SearchSales(Request $request)
    {
        $query = $request->get('query');
        $uid = session()->get('Active');
        $sales = DB::table('orders')->select('customer_name', 'date_of_order', 'product_name', 'product_qty', 'total_price')
        ->where('product_name', 'like', '%' . $query . '%')
        ->orWhere('customer_name', 'like', '%' . $query . '%')
            ->get();
        return view('Admin.sales', compact('sales', $uid));
    }

    function SearchProduct(Request $request)
    {
        $query = $request->get('query');
        $uid = session()->get('Active');
        $product = DB::table('products')
        ->join('suppliers', 'suppliers.account_id', '=', 'products.supplierID')
        ->select('Category', 'product_name', 'suppliers.Supplier_Name', 'product_qty', 'product_price', 'product_image', 'supplierID')
        ->where('Category', 'like', '%' . $query . '%')
            ->orWhere('product_name', 'like', '%' . $query . '%')
            ->orWhere('suppliers.Supplier_Name', 'like', '%' . $query . '%')
            ->get();
        return view('Admin.products', compact('product', $uid));
    }

    function SearchCustomer(Request $request)
    {
        $query = $request->get('query');
        $uid = session()->get('Active');
        $customer = DB::table('users')
        ->join('customers', 'users.id', '=', 'customers.account_id')
        ->select('users.email', 'users.account_type', 'customers.account_id', 'customers.Customer_Name', 'customers.Customer_Contact', 'customers.Customer_Address', 'customers.Gender')
            ->orWhere('customers.Customer_Name', 'like', '%' . $query . '%')
            ->orWhere('users.email', 'like', '%' . $query . '%')
            ->get();
        return view('Admin.customers', compact('customer', $uid));
    }

    function SearchSupplier(Request $request)
    {
        $query = $request->get('query');
        $uid = session()->get('Active');
        $supplier = DB::table('users')
        ->join('suppliers', 'users.id', '=', 'suppliers.account_id')
        ->select('users.email', 'users.account_type', 'suppliers.account_id', 'suppliers.Supplier_Name', 'suppliers.Supplier_Contact', 'suppliers.Supplier_Address', 'suppliers.Gender')
        ->orWhere('suppliers.Supplier_Name', 'like', '%' . $query . '%')
            ->orWhere('users.email', 'like', '%' . $query . '%')
            ->get();
        return view('Admin.suppliers', compact('supplier', $uid));
    }

    function SearchProd(Request $request)
    {
        $uid = session()->get('Active');
        $query = $request->get('query');
        if($query != ''){
        $product = DB::table('users')
        ->join('products', 'users.id', '=', 'products.supplierID')
        ->select('products.id','products.supplierID','products.Category', 'products.product_name', 'products.product_qty', 'products.product_price', 'products.product_image')
        ->orWhere('products.product_name', 'like', '%' . $query . '%')
            ->orWhere('products.Category', 'like', '%' . $query . '%')
            ->get();
        return view('Supplier.products', compact('product', $uid));
        }else{
            return redirect()->route('AddProduct.show',compact('uid'));
        }
    }
    function SearchingSales(Request $request)
    {
        $uid = session()->get('Active');
        $query = $request->get('query');
        if ($query != '') {
            $osales = DB::table('users')
                ->join('orders', 'users.id', '=', 'orders.sid')
                ->select('orders.date_of_order','orders.product_name', 'orders.product_qty', 'orders.total_price','orders.customer_name')
                ->orWhere('orders.product_name', 'like', '%' . $query . '%')
                ->orWhere('orders.customer_name', 'like', '%' . $query . '%')
                ->get();
            return view('Supplier.sales', compact('osales', $uid));
        } else {
            $user = session()->get('Active');
            $osales = DB::table('orders')->where('sid', '=', $user)->get();
            return view('Supplier.sales', compact('osales'));
        }
    }

}

