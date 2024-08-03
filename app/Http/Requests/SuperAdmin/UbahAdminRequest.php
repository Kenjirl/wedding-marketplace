<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class UbahAdminRequest extends FormRequest
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
            'nama'          =>'required|string|regex:/^[a-zA-Z\s]*$/|max:50',
            'no_telp'       =>'required|string|min:8|max:15',
            'gender'        =>'required|string|regex:/^[a-zA-Z\s]*$/|in:Pria,Wanita',
            'alamat_detail' =>'required|string',
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
            'nama.required'    => 'Nama tidak boleh kosong',
            'nama.string'      => 'Nama harus berupa karakter',
            'nama.regex'       => 'Nama tidak boleh memuat angka dan/atau tanda baca',
            'nama.max'         => 'Nama tidak boleh lebih dari 50 karakter',
            'no_telp.required' => 'Nomor Telepon tidak boleh kosong',
            'no_telp.string'   => 'Nomor Telepon harus berupa angka',
            'no_telp.min'      => 'Nomor Telepon minimal 8 karakter',
            'no_telp.max'      => 'Nomor Telepon maksimal 15 karakter',
            'gender.required'  => 'Jenis kelamin tidak boleh kosong',
            'gender.string'    => 'Jenis kelamin harus berupa karakter',
            'gender.regex'     => 'Jenis kelamin tidak boleh memuat angka dan/atau tanda baca',
            'gender.in'        => 'Jenis kelamin harus dipilih dari pilihan yang tersedia',
            'alamat.required'  => 'Alamat tidak boleh kosong',
            'alamat.string'    => 'Alamat harus berupa karakter',
        ];
    }
}
