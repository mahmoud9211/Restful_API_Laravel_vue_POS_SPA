<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use App\Models\supplier;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function category ()
    {
       $data = category::get();
        return response()->json($data);
    }

    public function supplier ()
    {
       $data = supplier::get();
        return response()->json($data);
    }

    public function quantity_update(Request $request,$id)
    {
        $validation = $request->validate([
           'qty' => 'required'
        ]);

        product::findOrFail($id)->update([
           'qty' => $request->qty
        ]);
    }
}
