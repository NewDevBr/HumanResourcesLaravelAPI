<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidateRequest extends FormRequest
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
            'name' => 'required|min:3|max:45',
            'titration' => 'required|max:45',
            'birthDate' => 'required|date',
            'email'=>'required|email|unique:candidates',
            'github' => 'required',
            'linkedin' => 'required',
            'notify_email' => 'required|boolean'
        ];
    }
}
