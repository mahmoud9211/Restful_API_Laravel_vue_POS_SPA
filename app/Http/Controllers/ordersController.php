<?php

namespace App\Http\Controllers;

use App\Models\expense;
use App\Models\order;
use App\Models\product;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ordersController extends Controller
{
    public function orders_today()
    {
        $data = order::with('customer')->where('order_date',date('Y-m-d'))->get();

        return response()->json($data);
    }

    public function order_details($id)
    {
        $data = order::with('customer')->findOrFail($id);
        return response()->json($data);
    }

    public function details($id)
    {
         $order = order::findOrFail($id);

         $data = $order->product()->get();
    

        return response()->json($data);

    }

    public function today_sell()
    {
        $data = order::where('order_date',date('Y-m-d'))->sum('total');

        return response()->json($data);

    }

    public function today_income()
    {
        $data = order::where('order_date',date('Y-m-d'))->sum('pay');

        return response()->json($data);

    }

    public function today_due()
    {
        $data = order::where('order_date',date('Y-m-d'))->sum('due');

        return response()->json($data);

    }

    public function today_expense()
    {
        $data = expense::where('date',date('Y-m-d'))->sum('amount');

        return response()->json($data);


    }

    public function order_search(Request $request)
    {

        $validation = $request->validate([
           'date' => 'required'
        ]);

        $search_date = $request->date;
        $order_date = new DateTime($search_date);
        $date = $order_date->format('Y-m-d');

        $data = order::where('order_date',$date)->with('customer')->get();
         
        return response()->json($data);


    }

    
}
