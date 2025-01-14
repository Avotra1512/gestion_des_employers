<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeAdminRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
        
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de l\'administrateur est requis',
            'email.required' => 'Le mail est requis',
            'email.email' => 'Le mail n\'est pas valide',
            'email.unique' => 'Cette edresse email est lié a un compte',
        ];
    }
}
