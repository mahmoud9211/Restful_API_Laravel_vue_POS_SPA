<?php

namespace App\Http\Controllers;

use App\Http\Requests\employeeRequest;
use App\Models\employee;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class employeesController extends Controller
{
   
    public function index()
    {
        $data = employee::paginate(10);

        return response()->json($data);
    }

    
    public function create()
    {
        //
    }

   
    public function store(employeeRequest $request)
    {
        $validated = $request->validated();

        if ($request->image)
        {
         $position = strpos($request->image, ';');
         $sub = substr($request->image, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($request->image)->resize(240,200);
         $upload_path = 'uploads/employees/';
         $image_url = $upload_path.$name;
         $img->save($image_url);

         
         $save_img = '/uploads/employees/'.$name;

          employee::create([
             'name' => $request->name,
             'email' => $request->email,
             'address' => $request->address,
             'salary' => $request->salary,
             'nid' => $request->nid,
             'joining_date' => $request->joining_date,
             'phone' => $request->phone,
             'image' => $save_img
          ]);
        }else {


            employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'salary' => $request->salary,
                'nid' => $request->nid,
                'joining_date' => $request->joining_date,
                'phone' => $request->phone,
                
             ]);




        }
        
    }

    
    public function show($id)
    {
        $data = employee::find($id);
        return response()->json($data);
    }

  
    public function edit($id)
    {
        //
    }

   
    public function update(employeeRequest $request, $id)
    {
        $validated = $request->validated();

        $old_image = employee::findOrFail($id)->image; 

        if($request->newimage)
        {
            if($old_image){
                $img_link = str_replace('/uploads','uploads',$old_image);
                unlink($img_link);

                $position = strpos($request->newimage, ';');
         $sub = substr($request->newimage, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($request->newimage)->resize(240,200);
         $upload_path = 'uploads/employees/';
         $image_url = $upload_path.$name;
         $img->save($image_url);

         
         $save_img = '/uploads/employees/'.$name;

          employee::findOrFail($id)->update([
             'name' => $request->name,
             'email' => $request->email,
             'address' => $request->address,
             'salary' => $request->salary,
             'nid' => $request->nid,
             'joining_date' => $request->joining_date,
             'phone' => $request->phone,
             'image' => $save_img
          ]);


            }else{

                $position = strpos($request->newimage, ';');
                $sub = substr($request->newimage, 0, $position);
                $ext = explode('/', $sub)[1];
       
                $name = time().".".$ext;
                $img = Image::make($request->newimage)->resize(240,200);
                $upload_path = 'uploads/employees/';
                $image_url = $upload_path.$name;
                $img->save($image_url);
       
                
                $save_img = '/uploads/employees/'.$name;
       
                 employee::findOrFail($id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'salary' => $request->salary,
                    'nid' => $request->nid,
                    'joining_date' => $request->joining_date,
                    'phone' => $request->phone,
                    'image' => $save_img
                 ]);


            }


        }else{

            employee::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'salary' => $request->salary,
                'nid' => $request->nid,
                'joining_date' => $request->joining_date,
                'phone' => $request->phone
             ]);



        }
    }

  
    public function destroy($id)
    {
        $image = employee::findOrFail($id)->image;
         $img_link = str_replace('/uploads','uploads',$image);
        if($image)
        { 
            unlink($img_link);
           employee::findOrFail($id)->delete();

        }else{
            employee::findOrFail($id)->delete();
        }
    }
}
