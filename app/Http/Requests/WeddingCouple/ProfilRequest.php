<?php

namespace App\Http\Requests\WeddingCouple;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfilRequest extends FormRequest
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
            'nama'    =>'required|string|regex:/^[a-zA-Z\s]*$/|max:50',
            'username'=>[
                'required',
                Rule::unique('users', 'name')->ignore(auth()->id()),
            ],
            'no_telp' =>'required|string|min:8|max:12',
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
            'nama.required'          => 'Nama tidak boleh kosong',
            'nama.string'            => 'Nama harus berupa karakter',
            'nama.regex'             => 'Nama tidak boleh memuat angka dan/atau tanda baca',
            'nama.max'               => 'Nama tidak boleh lebih dari 50 karakter',
            'username.required'      => 'Username tidak boleh kosong',
            'username.unique'        => 'Username sudah digunakan',
            'no_telp.required'       => 'Nomor Telepon tidak boleh kosong',
            'no_telp.string'         => 'Nomor Telepon harus berupa angka',
            'no_telp.min'            => 'Nomor Telepon minimal 8 karakter',
            'no_telp.max'            => 'Nomor Telepon maksimal 12 karakter',
        ];
    }
}
