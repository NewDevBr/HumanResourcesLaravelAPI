<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVacancyRequest extends FormRequest
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
            'title' => 'required|max:45|min:3',
            'description' => 'required|max:3500|min:2',
            'remote' => 'required',
            'hiring' => 'required',
            'admin_id' => 'required|integer',
            'technologies'=> 'required'
        ];
    }
}
