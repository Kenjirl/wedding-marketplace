<?php

namespace App\Http\Requests\WeddingPhotographer;

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
            'nama'          =>'required|string|regex:/^[a-zA-Z\s]*$/|max:50',
            'username'      =>[
                'required',
                Rule::unique('users', 'name')->ignore(auth()->id()),
            ],
            'no_telp'       =>'required|string|min:8|max:12',
            'gender'        =>'string|regex:/^[a-zA-Z\s]*$/|in:Pria,Wanita',
            'basis_operasi' =>'required|string|regex:/^[a-zA-Z\s]*$/|in:Hanya di Dalam Kota,Bisa ke Luar Kota',
            'kota_operasi'  =>'string|regex:/^[a-zA-Z\s]*$/',
            'status'        =>'required|string|regex:/^[a-zA-Z\s]*$/|in:Individu,Organisasi',
            'provinsi'      =>'string|regex:/^[a-zA-Z\s]*$/',
            'kota'          =>'string|regex:/^[a-zA-Z\s]*$/',
            'kecamatan'     =>'string|regex:/^[a-zA-Z\s]*$/',
            'kelurahan'     =>'string|regex:/^[a-zA-Z\s]*$/',
            'alamat_detail' =>'string|regex:/^[a-zA-Z\s.0-9]*$/',
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
            'gender.required'        => 'Gender tidak boleh kosong',
            'gender.string'          => 'Gender harus berupa karakter',
            'gender.regex'           => 'Gender tidak boleh memuat angka dan/atau tanda baca',
            'gender.in'              => 'Gender harus dipilih dari pilihan yang tersedia',
            'basis_operasi.required' => 'Basis Operasi tidak boleh kosong',
            'basis_operasi.string'   => 'Basis Operasi harus berupa karakter',
            'basis_operasi.regex'    => 'Basis Operasi tidak boleh memuat angka dan/atau tanda baca',
            'basis_operasi.in'       => 'Basis Operasi harus dipilih dari pilihan yang tersedia',
            'kota_operasi.string'    => 'Kota Operasi harus berupa karakter',
            'kota_operasi.regex'     => 'Kota Operasi tidak boleh memuat angka dan/atau tanda baca',
            'status.required'        => 'Status tidak boleh kosong',
            'status.string'          => 'Status harus berupa karakter',
            'status.regex'           => 'Status tidak boleh memuat angka dan/atau tanda baca',
            'status.in'              => 'Status harus dipilih dari pilihan yang tersedia',
            'provinsi.string'        => 'Provinsi harus berupa karakter',
            'provinsi.regex'         => 'Provinsi tidak boleh memuat angka dan/atau tanda baca',
            'kota.string'            => 'Kota harus berupa karakter',
            'kota.regex'             => 'Kota tidak boleh memuat angka dan/atau tanda baca',
            'kecamatan.string'       => 'Kecamatan harus berupa karakter',
            'kecamatan.regex'        => 'Kecamatan tidak boleh memuat angka dan/atau tanda baca',
            'kelurahan.string'       => 'Kelurahan harus berupa karakter',
            'kelurahan.regex'        => 'Kelurahan tidak boleh memuat angka dan/atau tanda baca',
            'alamat_detail.string'   => 'Alamat Detail harus berupa karakter',
            'alamat_detail.regex'    => 'Alamat Detail tidak boleh memuat tanda baca selain titik',
        ];
    }
}
