<?php

namespace App\Http\Requests;

use App\Rules\ReCaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'recaptcha_token' => ['required', new   ReCaptchaRule($this->recaptcha_token)]
        ];
    }

    public function messages()
    {
        return [
            'recaptcha_token.required' => 'El campo recaptcha es requerido.'
        ];
    }
}
