<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'name' => 'required|max:45|min:3',
            'email' => 'required|email|unique:admins',
            'post' => 'required|Min:3|max:45',
            'password' => 'required|min:8',
            'created_by_admin' => 'required'
        ];
    }
}
