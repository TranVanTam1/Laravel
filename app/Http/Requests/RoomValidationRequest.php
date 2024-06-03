<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            
            "name" =>"required",
            "description"  => "required",
            "unit_price" => "required",
            "promotion_price"  => "required",
            "id_type" =>"required",
            "new" =>"required",
            'image'=>'mimes:jpeg,jpg,png,gif|max:10000'
        ];
    }
    
}
