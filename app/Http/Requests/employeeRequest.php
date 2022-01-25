<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class employeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:employees,email,'.$this->id,
            'address' => 'required',
            'salary' => 'required',
            'joining_date' => 'required',
            'nid' => 'required',
            'phone' => 'required|max:11',
        ];
    }
}
