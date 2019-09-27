<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UserRequest extends FormRequest{
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
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users'.((isset($this->user)) ? ',email,'.$this->user->id : '')
        ];
        if(!isset($this->user)){
            $rules += ['password' => 'required'];
        }
        return $rules;
    }
    public function messages(){
        return [
            'name.required' => 'Please enter name',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter valid email',
            'email.unique' => 'Email already exist',
            'password.required' => 'Please enter password',
        ];
    }
}