<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployerRequest extends FormRequest
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
            'departement_id'=>'required|integer',
            'nom'=>'required|string',
            'prenom'=>'required|string',
            'date_naissance'=>'required|date',
            'sexe'=>'required|string',
            'email'=>'required',
            'contact'=>'required',
            'photos' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Le mail est requis',
            'contact.required' => 'Le numéro de telephone est requis',
            'nom.required' => 'Le nom est requis',
            'prenom.required' => 'Le prenom est requis',
            'date_naissance.required' => 'La date de naissance est requis',
            'sexe.required' => 'Le sexe est requis',
        ];
    }
}
