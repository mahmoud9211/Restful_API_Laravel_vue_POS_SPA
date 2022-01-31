<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\cart;
use App\Models\order;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Request $request,$id)
    {
        $product = product::findOrFail($id);

        $check = cart::where('product_id',$id)->first();



        if($check){

            cart::where('product_id',$id)->increment('qty');

            cart::where('product_id',$id)->update([
                'sub_total' => $check->price * $check->qty
            ]);

            

        }else{

            cart::create([
                'product_id' => $id,
                'qty' => 1,
                'price' => $product->selling_price,
                'sub_total' => $product->selling_price
              ]);

        }

     
    }

    public function getContent()
    {
        $data = cart::with('product')->get();

        return response()->json($data);
    }

    public function remove($id)
    {
        cart::findOrFail($id)->delete();
    }

    public function increment($id)
    {
        cart::findOrFail($id)->increment('qty');

        $data = cart::findOrFail($id);

        $data->update([
          'sub_total' => $data->qty * $data->price
        ]);
    }

    public function decrement($id)
    {
        cart::findOrFail($id)->decrement('qty');

        $data = cart::findOrFail($id);

        $data->update([
          'sub_total' => $data->qty * $data->price
        ]);
    }

   public function order_insert (OrderRequest $request)
   {
       $validation = $request->validated();

     $order =  order::create([
           'customer_id' => $request->customer_id,
           'qty' => $request->quantity,
           'subtotal' => $request->subTotal,
           'total' => $request->total,
           'vat' => 10,
           'payment_method' => $request->payment_method,
           'pay' => $request->pay,
           'due' => $request->due,
           'order_date' => Carbon::now(),
           'order_month' => date('F'),
           'order_year' => date('Y'),

       ]);

       $products = cart::get();

       foreach($products as $product)
       {
           $order->product()->attach($product->product_id);
       
             
           $qty =  product::findOrFail($product->product_id)->qty;

           product::findOrFail($product->product_id)->update([
                'qty' =>  $qty - $product->qty
           ]);

           DB::table('order_product')->where('product_id',$product->product_id)->update([
               'qty' => $product->qty
           ]);
       }
      
       //to empty the cart
       cart::truncate();
       



      
       
     
   }
}
