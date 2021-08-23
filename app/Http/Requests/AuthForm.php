<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AuthForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Auth::check();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $formRules = [
            "name" =>[
                'required'
            ],
            "email"=>[
                "required",
                "regex:/(.+)@(.+)\.(.+)/i"
            ],
            "password"=>[
                "required",
                "min:8"
            ]
        ];

        return $formRules;
    }
    public function messages()
    {
//        return parent::messages(); // TODO: Change the autogenerated stub
        $message = [
            "name.required" => "Bạn chưa nhập họ tên.",
            "email.required"=> "Bạn chưa nhập Email.",
            "email.regex"=>"Đinh dạng Email chưa đúng.",
            'password.required'=>"Mật khẩu không để trống.",
            "password.min"=>"Mật khẩu tối thiểu 8 ký tự.",
        ];
        return $message;
    }
}