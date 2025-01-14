<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class submiteDefineAccessRequest extends FormRequest
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
            'code'=>'required|exists:reset_code_passwords,code',
            'password'=>'required|same:confirm_password',
            'confirm_password'=>'required|same:password',
        ];
    }
    
    public function messages()
    {
        return[
            'code.required'=>'Le code est requis',
            'code.exists'=>'Ce code n\'est pas valide. Consultez votre email!',
            'password.same'=>'Les mots de passses ne correspondent pas',
            'confirm_password.same'=>'Les mots de passses ne correspondent pas'
        ];
    }
}
