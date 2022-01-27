<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function products ()
    {
        $data = product::get();

        return response()->json($data);
    }

    public function products_by_categories($id)
    {
      $data = product::where('category_id',$id)->get();

      return response()->json($data);

    }
}
