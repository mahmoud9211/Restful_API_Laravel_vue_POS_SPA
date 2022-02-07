<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\category;
use App\Models\product;
use App\Models\supplier;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ProductsController extends Controller
{
   
    public function index()
    {
        $data = product::with('category')->paginate(10);

        return response()->json($data);
    }

    
    public function create()
    {
        //
    }

    
    public function store(ProductRequest $request)
    {
        $validation = $request->validated();

        $position = strpos($request->image, ';');
        $sub = substr($request->image, 0, $position);
        $ext = explode('/', $sub)[1];

        $name = time().".".$ext;
        $img = Image::make($request->image)->resize(240,200);
        $upload_path = 'uploads/products/';
        $image_url = $upload_path.$name;
        $img->save($image_url);

        
        $save_img = '/uploads/products/'.$name;

        product::create([

            'name' => $request->name,
            'code' => $request->code,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'purchase_date' => $request->purchase_date,
            'qty' => $request->qty,
            'image' => $save_img

        ]);
    }

    
    public function show($id)
    {
        $data = product::findOrFail($id);

        return response()->json($data);
    }

  
    public function edit($id)
    {
        //
    }

   
    public function update(ProductRequest $request, $id)
    {
        $validation = $request->validated();

        if($request->newimage)
        {
            $image = product::findOrFail($id)->image;
            $img_link = str_replace('/uploads','uploads',$image);
    
            unlink($img_link);

            $position = strpos($request->newimage, ';');
        $sub = substr($request->newimage, 0, $position);
        $ext = explode('/', $sub)[1];

        $name = time().".".$ext;
        $img = Image::make($request->newimage)->resize(240,200);
        $upload_path = 'uploads/products/';
        $image_url = $upload_path.$name;
        $img->save($image_url);

        $save_img = '/uploads/products/'.$name;


        product::findOrFail($id)->update([

            'name' => $request->name,
            'code' => $request->code,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'purchase_date' => $request->purchase_date,
            'qty' => $request->qty,
            'image' => $save_img

        ]);


        }else{

            product::findOrFail($id)->update([

                'name' => $request->name,
                'code' => $request->code,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'purchase_price' => $request->purchase_price,
                'selling_price' => $request->selling_price,
                'purchase_date' => $request->purchase_date,
                'qty' => $request->qty
    
            ]);

        }

    }


    public function destroy($id)
    {
        
        $image = product::findOrFail($id)->image;
        $img_link = str_replace('/uploads','uploads',$image);

        unlink($img_link);

        product::findOrFail($id)->delete();

        
    }

    
}
