<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\category;

class CategoriesController extends Controller
{

    public function index()
    {
        $data = category::paginate(5);

        return response()->json($data);
    }

  
    public function create()
    {
        //
    }

   
    public function store(CategoryRequest $request)
    {
       $validation = $request->validated();
       
       category::create([
          'name' => $request->name
       ]);
    }

   
    public function show($id)
    {
        $data = category::findOrFail($id);

        return response()->json($data);
    }

 
    public function edit($id)
    {
     
    }

    
    public function update(CategoryRequest $request, $id)
    {
        $validation = $request->validated();
       
       category::findOrFail($id)->update([
          'name' => $request->name
       ]);
    }

    
    public function destroy($id)
    {
        category::findOrFail($id)->delete();
    }
}
