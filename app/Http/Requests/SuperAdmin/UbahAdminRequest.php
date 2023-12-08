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
            'no_telp'       =>'required|string|min:8|max:12',
            'gender'        =>'required|string|regex:/^[a-zA-Z\s]*$/|in:Pria,Wanita',
            'provinsi'      =>'required|string|regex:/^[a-zA-Z\s()]*$/',
            'kota'          =>'required|string|regex:/^[a-zA-Z\s()]*$/',
            'kecamatan'     =>'required|string|regex:/^[a-zA-Z\s()]*$/',
            'kelurahan'     =>'required|string|regex:/^[a-zA-Z\s()]*$/',
            'alamat_detail' =>'required|string|regex:/^[a-zA-Z\s.0-9]*$/',
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
            'no_telp.required'       => 'Nomor Telepon tidak boleh kosong',
            'no_telp.string'         => 'Nomor Telepon harus berupa angka',
            'no_telp.min'            => 'Nomor Telepon minimal 8 karakter',
            'no_telp.max'            => 'Nomor Telepon maksimal 12 karakter',
            'gender.required'        => 'Gender tidak boleh kosong',
            'gender.string'          => 'Gender harus berupa karakter',
            'gender.regex'           => 'Gender tidak boleh memuat angka dan/atau tanda baca',
            'gender.in'              => 'Gender harus dipilih dari pilihan yang tersedia',
            'provinsi.required'      => 'Provinsi tidak boleh kosong',
            'provinsi.string'        => 'Provinsi harus berupa karakter',
            'provinsi.regex'         => 'Provinsi harus dipilih dari pilihan yang tersedia',
            'kota.required'          => 'Kota tidak boleh kosong',
            'kota.string'            => 'Kota harus berupa karakter',
            'kota.regex'             => 'Kota harus dipilih dari pilihan yang tersedia',
            'kecamatan.required'     => 'Kecamatan tidak boleh kosong',
            'kecamatan.string'       => 'Kecamatan harus berupa karakter',
            'kecamatan.regex'        => 'Kecamatan harus dipilih dari pilihan yang tersedia',
            'kelurahan.required'     => 'Kelurahan tidak boleh kosong',
            'kelurahan.string'       => 'Kelurahan harus berupa karakter',
            'kelurahan.regex'        => 'Kelurahan harus dipilih dari pilihan yang tersedia',
            'alamat_detail.required' => 'Alamat Detail tidak boleh kosong',
            'alamat_detail.string'   => 'Alamat Detail harus berupa karakter',
            'alamat_detail.regex'    => 'Alamat Detail tidak boleh memuat tanda baca selain titik',
        ];
    }
}
