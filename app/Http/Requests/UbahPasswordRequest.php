<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UbahPasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password'  => 'required|min:6',
            'vPassword' => 'required|same:password',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'password.required'  => 'Password tidak boleh kosong',
            'password.min'       => 'Password minimal terdiri dari 6 karakter',
            'vPassword.required' => 'Validasi password tidak boleh kosong',
            'vPassword.same'     => 'Validasi dan password harus sama',
        ];
    }
}
