<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /**public function authorize()
    {
        return false;
    }
    */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_mail' => 'required|email',
            'support_mail' => 'required|email',
            'support_text' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'company_mail.required' => '必須項目です',
            'company_mail.email' => 'メールアドレスの形式で入力してください',
            'support_mail.required' => '必須項目です',
            'support_mail.email' => 'メールアドレスの形式で入力してください',
            'support_text.required' => '必須項目です',
        ];
    }
}
