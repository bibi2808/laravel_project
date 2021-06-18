<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
{
    protected $table = 'user';
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
            'username'          =>  "bail|between:5,100",
            'fullname'          =>  "bail|between:5,100",
            'email'             =>  "bail|required|email|unique:user,email",
            'password'          =>  "bail|required|between:5,100"
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required' => 'A name is required',
    //         'name.min' => 'A name at least :min characters',
    //         'description.required' => 'A description is required',
            
    //     ];
    // }

    // public function attributes()
    // {
    //     return [
    //         'description' => 'description address',
    //     ];
    // }
}
