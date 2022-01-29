<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\product;
use Illuminate\Http\Request;

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

   
}
