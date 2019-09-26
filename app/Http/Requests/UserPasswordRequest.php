<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UserPasswordRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return \Auth::check();
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'old_pwd' => 'required',
            'new_pwd' => 'required|same:confirm_pwd',
            'confirm_pwd' => 'required'
        ];
    }
    public function messages(){
        return [
            'old_pwd.required' => 'Please enter old password',
            'new_pwd.required' => 'Please enter new password',
            'new_pwd.same' => 'Password do not match',
            'confirm_pwd.required' => 'Please confirm password'
        ];
    }
}