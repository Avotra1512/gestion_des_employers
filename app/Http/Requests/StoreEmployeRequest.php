<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeRequest extends FormRequest
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
            'date_naissance'=>'nullable|date',
            'sexe'=>'required|string',
            'email'=>'required|unique:employers,email',
            'contact'=>'required|unique:employers,contact',
            'photos'=>'required|string',
            'montant_journalier'=>'nullable',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Le mail est requis',
            'email.unique' => 'Le mail est déja pris',
            'contact.required' => 'Le numéro de telephone est requis',
            'contact.unique' => 'Le numéro de telephone est déja pris'
        ];
    }
}
