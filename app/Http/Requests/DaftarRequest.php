<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DaftarRequest extends FormRequest
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
            'email'     => 'required|email|unique:users,email',
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
            'email.required'     => 'Harap masukkan email',
            'email.email'        => 'Email tidak valid',
            'email.unique'       => 'Email sudah terdaftar',
            'password.required'  => 'Harap masukkan password',
            'password.min'       => 'Password minimal terdiri dari 6 karakter',
            'vPassword.required' => 'Harap masukan validasi password',
            'vPassword.same'     => 'Validasi password dan password harus sama',
        ];
    }
}
