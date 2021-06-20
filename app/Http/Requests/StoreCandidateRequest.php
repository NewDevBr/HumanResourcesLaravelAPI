<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCandidateRequest extends FormRequest
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
            'img' => 'required|image',
            'name' => 'required|min:3|max:45',
            'titration' => 'required|max:45',
            'birthDate' => 'required|date',
            'email'=>'required|email|unique:candidates',
            'password' => 'required|min:8',
            'github' => 'required',
            'linkedin' => 'required'
        ];
    }
}
