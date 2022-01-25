<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpensesRequest;
use App\Models\expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    
    public function index()
    {
        $data = expense::latest()->paginate(10);

        return response()->json($data);
        
    }

    
    public function create()
    {
        //
    }

   
    public function store(ExpensesRequest $request)
    {
        $validation = $request->validated();

        expense::create([
         'details' => $request->details,
         'amount' => $request->amount
        ]);
        
    }

    public function show($id)
    {
        $data = expense::findOrFail($id);
        return response()->json($data);
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(ExpensesRequest $request, $id)
    {

        $validation = $request->validated();

        expense::findOrFail($id)->update([
         'details' => $request->details,
         'amount' => $request->amount
        ]);
        
    }


    public function destroy($id)
    {
        expense::findOrFail($id)->delete();
    }
}
