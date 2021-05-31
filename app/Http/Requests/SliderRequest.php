<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            // 'name'          => 'bail|required|min:5|max:100',
            // 'description'   => 'bail|required',
            // 'link'          => 'bail|required|min:5|url',
            // 'status'        => 'bail|in:active,inactive',
            'thumb'         => 'bail|required|image|max:100'
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
