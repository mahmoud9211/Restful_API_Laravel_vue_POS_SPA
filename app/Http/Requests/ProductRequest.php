<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

  
    public function rules()
    {
        return [
            'name' => 'required',
            'code' => 'required|unique:products,code,'.$this->id,
            'category_id' => 'required',
            'supplier_id' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'purchase_date' => 'required',
            'qty' => 'required|numeric',
            
        ];
    }
}
