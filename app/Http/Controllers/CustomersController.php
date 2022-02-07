<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = customer::paginate(10);
        return response()->json($data);
    }

  
    public function create()
    {
        //
    }

   
    public function store(CustomerRequest $request)
    {
        $validation = $request->validated();

        customer::create([

            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
    }


    public function show($id)
    {
        $data = customer::findOrFail($id);

        return response()->json($data);
    }

  
    public function edit($id)
    {
        //
    }

    
    public function update(CustomerRequest $request, $id)
    {
        $validation = $request->validated();

        customer::findOrFail($id)->update([

            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
    }

   
    public function destroy($id)
    {
        customer::findOrFail($id)->delete();
    }
}
