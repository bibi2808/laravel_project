<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    protected $table = 'category';
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
        $id = $this->id;

        $condName = "bail|required|between:5,100|unique:$this->table,name";

        if(!empty($id)){
            $condName .= ",$id";
        }
        return [
            'name'          =>  $condName,
            'status'        => 'bail|in:active,inactive'
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
