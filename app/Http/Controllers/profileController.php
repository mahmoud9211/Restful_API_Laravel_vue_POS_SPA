<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Exception;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class profileController extends Controller
{
    public function profile (Request $request,$token)
    {
        
            if (! $token = JWTAuth::parseToken()) {
                //throw an exception
                return response()->json(['error' => 'Incorrect Email Or Password'], 401);

            }
        


            $data = User::findOrFail(auth()->id());
            return response()->json($data);
     
    }

    public function edit($token)
    {
        if (! $token = JWTAuth::parseToken()) {
            //throw an exception
            return response()->json(['error' => 'Incorrect Email Or Password'], 401);

        }

     
       $data = User::findOrFail(auth()->id());
       return response()->json($data);


    }

    public function update(Request $request,$token)
    {
        if (! $token = JWTAuth::parseToken()) {
            //throw an exception
            return response()->json(['error' => 'Incorrect Email Or Password'], 401);

        }

        $old_image = User::find(auth()->id())->photo; 


        if($request->newphoto)

        {
            if($old_image){
                $img_link = str_replace('/uploads','uploads',$old_image);
                unlink($img_link);

                $position = strpos($request->newphoto, ';');
         $sub = substr($request->newphoto, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($request->newphoto)->resize(240,200);
         $upload_path = 'uploads/profile/';
         $image_url = $upload_path.$name;
         $img->save($image_url);

         
         $save_img = '/uploads/profile/'.$name;

         User::findOrFail(auth()->id())->update([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'photo' => $save_img 


        ]);

        

        }else{

            $position = strpos($request->newphoto, ';');
            $sub = substr($request->newphoto, 0, $position);
            $ext = explode('/', $sub)[1];
   
            $name = time().".".$ext;
            $img = Image::make($request->newphoto)->resize(240,200);
            $upload_path = 'uploads/profile/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
   
            
            $save_img = '/uploads/profile/'.$name;

            User::findOrFail(auth()->id())->update([

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
                'photo' => $save_img 

    
            ]);

        }
          

        

    }else{

        User::findOrFail(auth()->id())->update([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,


        ]);


            
    }

}

public function password(Request $request,$token)
{
    $validation = $request->validate([
        'oldpassword' => 'required',
        'password' => 'required|confirmed'
    ]);

    if (! $token = JWTAuth::parseToken()) {
        //throw an exception
        return response()->json(['error' => 'Incorrect Email Or Password'], 401);

    }

    $data = User::findOrFail(auth()->id());

     if(Hash::check($request->oldpassword,$data->password))
     {
        $data->update([
            'password' => Hash::make($request->password)
         ]);
    
     }else{

        return response()->json([
            'error' => 'The current password is not correct'
        ]);
     }




     


}


        protected function respondWithToken($token)
        {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
               //  'expires_in' => auth()->factory()->getTTL() * 60,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
                'address' => Auth::user()->address,
                'birth_date' => Auth::user()->birth_date,
                

            ]);
        }
    
            

      
        
         


    }

