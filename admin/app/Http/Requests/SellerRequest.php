<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:sellers|email|max:255',
            'password' => 'required|min:6',
            'password_confirmation' => 'required', 
            'company_name' => 'required|max:255',
            'image' => 'required|mimes:jpeg,jpg,png',
            'zip_code' => 'required|max:255',
            'cnpj' => 'required|unique:sellers|max:255',
            'bank' => 'required|max:255',
            'agency' => 'required|max:255',
            'account' => 'required|unique:sellers|max:255'
        ];
    }
}
