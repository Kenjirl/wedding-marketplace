<?php

namespace App\Http\Requests\WeddingOrganizer;

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
            'nama'   =>'required|string|regex:/^[a-zA-Z\s]*$/|max:50',
            'username'       =>[
                'required',
                Rule::unique('users', 'name')->ignore(auth()->id()),
            ],
            'no_telp'        =>'required|string|min:8|max:15',
            'alamat'         =>'required|string',
            'basis_operasi'  =>'required|string|regex:/^[a-zA-Z\s]*$/|in:Hanya di Dalam Kota,Bisa ke Luar Kota',
            'kota_operasi'   =>'string',
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
            'nama.required'           => 'Nama tidak boleh kosong',
            'nama.string'             => 'Nama harus berupa karakter',
            'nama.regex'              => 'Nama tidak boleh memuat angka dan/atau tanda baca',
            'nama.max'                => 'Nama tidak boleh lebih dari 50 karakter',
            'username.required'       => 'Username tidak boleh kosong',
            'username.unique'         => 'Username sudah digunakan',
            'no_telp.required'        => 'Nomor Telepon tidak boleh kosong',
            'no_telp.string'          => 'Nomor Telepon harus berupa angka',
            'no_telp.min'             => 'Nomor Telepon minimal 8 karakter',
            'no_telp.max'             => 'Nomor Telepon maksimal 15 karakter',
            'alamat.required'         => 'Alamat tidak boleh kosong',
            'alamat.string'           => 'Alamat harus berupa karakter',
            'basis_operasi.required'  => 'Basis Operasi tidak boleh kosong',
            'basis_operasi.string'    => 'Basis Operasi harus berupa karakter',
            'basis_operasi.regex'     => 'Basis Operasi harus dipilih dari pilihan yang tersedia',
            'basis_operasi.in'        => 'Basis Operasi harus dipilih dari pilihan yang tersedia',
            'kota_operasi.string'     => 'Kota Operasi harus berupa karakter',
            'kota_operasi.regex'      => 'Kota Operasi harus dipilih dari pilihan yang tersedia',
        ];
    }
}
