<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;
use App\Models\supplier;
use Intervention\Image\Facades\Image;

class SuppliersController extends Controller
{
  
    public function index()
    {
        $data = supplier::paginate(10);

        return response()->json($data);
    }

   
    public function create()
    {
        //
    }

    public function store(SupplierRequest $request)
    {
        $validated = $request->validated();

        if($request->image)
        {
            $position = strpos($request->image, ';');
         $sub = substr($request->image, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($request->image)->resize(240,200);
         $upload_path = 'uploads/suppliers/';
         $image_url = $upload_path.$name;
         $img->save($image_url);

         
         $save_img = '/uploads/suppliers/'.$name;

         supplier::create([

            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $save_img

         ]);


        }else{

            supplier::create([

                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone

             ]);


        }
    }

   
    public function show($id)
    {
        $data = supplier::find($id);

        return response()->json($data);
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(SupplierRequest $request, $id)
    {
        $validated = $request->validated();
        
        $old_img = supplier::findOrFail($id)->image;

        if($request->newimage)
        {
            if($old_img)
            {
                $img_link = str_replace('/uploads','uploads',$old_img);
                unlink($img_link);

                $position = strpos($request->newimage, ';');
                $sub = substr($request->newimage, 0, $position);
                $ext = explode('/', $sub)[1];
       
                $name = time().".".$ext;
                $img = Image::make($request->newimage)->resize(240,200);
                $upload_path = 'uploads/suppliers/';
                $image_url = $upload_path.$name;
                $img->save($image_url);
       
                
                $save_img = '/uploads/suppliers/'.$name;
       
                supplier::findOrfail($id)->update([
       
                   'name' => $request->name,
                   'email' => $request->email,
                   'address' => $request->address,
                   'phone' => $request->phone,
                   'image' => $save_img
       
                ]);



            }else{

                $position = strpos($request->newimage, ';');
                $sub = substr($request->newimage, 0, $position);
                $ext = explode('/', $sub)[1];
       
                $name = time().".".$ext;
                $img = Image::make($request->newimage)->resize(240,200);
                $upload_path = 'uploads/suppliers/';
                $image_url = $upload_path.$name;
                $img->save($image_url);
       
                
                $save_img = '/uploads/suppliers/'.$name;
       
                supplier::findOrfail($id)->update([
       
                   'name' => $request->name,
                   'email' => $request->email,
                   'address' => $request->address,
                   'phone' => $request->phone,
                   'image' => $save_img
       
                ]);

            }



        }else{

            supplier::findOrfail($id)->update([
       
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone
    
             ]);



        }
    }

   
    public function destroy($id)
    {
        $image = supplier::findOrFail($id)->image;
        $img_link = str_replace('/uploads','uploads',$image);

        if($image)
        {
          unlink($img_link);
          supplier::findOrFail($id)->delete();

        }else{

            supplier::findOrFail($id)->delete();

        }
    }
}
