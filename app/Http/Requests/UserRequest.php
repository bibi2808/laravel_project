<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->id;
        $condUsername =  '';
        $condEmail    =  '';
        $condFullname =  '';
        $condStatus   =  '';
        $condLevel    =  '';
        $condPassword =  '';
        $condAvatar   =  '';

        switch ($this->task) {
            case 'add':
                $condUsername          =  "bail|required|between:5,100|unique:$this->table,username";
                $condEmail             =  "bail|required|email|unique:$this->table,email";
                $condFullname          =  "bail|required|min:5";
                $condPassword          =  "bail|required|between:5,100|confirmed";
                $condStatus            =  "bail|in:active,inactive";
                $condLevel             =  "bail|in:admin,member";
                $condAvatar            =  "bail|required|image|max:500";
                break;
            case 'edit_info':
                $condUsername          =  "bail|required|between:5,100|unique:$this->table,username,$id";
                $condEmail             =  "bail|required|email|unique:$this->table,email,$id";
                $condFullname          =  "bail|required|min:5";
                $condStatus            =  "bail|in:active,inactive";
                $condAvatar            =  "bail|image|max:100000";
                break;
            case 'change_password':
                $condPassword          =  "bail|required|between:5,100|confirmed";
                break;
            case 'change_level':
                $condLevel             =  "bail|in:admin,member";
                break;
            default:
                break;
        }
        
        return [
            'username'          =>  $condUsername,
            'email'             =>  $condEmail,
            'fullname'          =>  $condFullname,
            'status'            =>  $condStatus,
            'level'             =>  $condLevel,
            'password'          =>  $condPassword,
            'avatar'            =>  $condAvatar
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
