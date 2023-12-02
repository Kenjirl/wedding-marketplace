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
            'nama_pemilik'   =>'required|string|regex:/^[a-zA-Z\s]*$/|max:50',
            'nama_perusahaan'=>'required|string|regex:/^[a-zA-Z\s.0-9]*$/|max:50',
            'username'       =>[
                'required',
                Rule::unique('users', 'name')->ignore(auth()->id()),
            ],
            'no_telp'        =>'required|string|min:8|max:12',
            'basis_operasi'  =>'required|string|regex:/^[a-zA-Z\s]*$/|in:Hanya di Dalam Kota,Bisa ke Luar Kota',
            'kota_operasi'   =>'string|regex:/^[a-zA-Z\s]*$/',
            'provinsi'       =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'kota'           =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'kecamatan'      =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'kelurahan'      =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'alamat_detail'  =>'required|string|regex:/^[a-zA-Z\s.0-9]*$/',
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
            'nama_pemilik.required'   => 'Nama Pemilik tidak boleh kosong',
            'nama_pemilik.string'     => 'Nama Pemilik harus berupa karakter',
            'nama_pemilik.regex'      => 'Nama Pemilik tidak boleh memuat angka dan/atau tanda baca',
            'nama_pemilik.max'        => 'Nama Pemilik tidak boleh lebih dari 50 karakter',
            'nama_perusahaan.required'=> 'Nama Perusahaan tidak boleh kosong',
            'nama_perusahaan.string'  => 'Nama Perusahaan harus berupa karakter',
            'nama_perusahaan.regex'   => 'Nama Perusahaan tidak boleh memuat tanda baca selain titik',
            'nama_perusahaan.max'     => 'Nama Perusahaan tidak boleh lebih dari 50 karakter',
            'username.required'       => 'Username tidak boleh kosong',
            'username.unique'         => 'Username sudah digunakan',
            'no_telp.required'        => 'Nomor Telepon tidak boleh kosong',
            'no_telp.string'          => 'Nomor Telepon harus berupa angka',
            'no_telp.min'             => 'Nomor Telepon minimal 8 karakter',
            'no_telp.max'             => 'Nomor Telepon maksimal 12 karakter',
            'basis_operasi.required'  => 'Basis Operasi tidak boleh kosong',
            'basis_operasi.string'    => 'Basis Operasi harus berupa karakter',
            'basis_operasi.regex'     => 'Basis Operasi tidak boleh memuat angka dan/atau tanda baca',
            'basis_operasi.in'        => 'Basis Operasi harus dipilih dari pilihan yang tersedia',
            'kota_operasi.string'     => 'Kota Operasi harus berupa karakter',
            'kota_operasi.regex'      => 'Kota Operasi tidak boleh memuat angka dan/atau tanda baca',
            'provinsi.required'       => 'Provinsi tidak boleh kosong',
            'provinsi.string'         => 'Provinsi harus berupa karakter',
            'provinsi.regex'          => 'Provinsi tidak boleh memuat angka dan/atau tanda baca',
            'kota.required'           => 'Kota tidak boleh kosong',
            'kota.string'             => 'Kota harus berupa karakter',
            'kota.regex'              => 'Kota tidak boleh memuat angka dan/atau tanda baca',
            'kecamatan.required'      => 'Kecamatan tidak boleh kosong',
            'kecamatan.string'        => 'Kecamatan harus berupa karakter',
            'kecamatan.regex'         => 'Kecamatan tidak boleh memuat angka dan/atau tanda baca',
            'kelurahan.required'      => 'Kelurahan tidak boleh kosong',
            'kelurahan.string'        => 'Kelurahan harus berupa karakter',
            'kelurahan.regex'         => 'Kelurahan tidak boleh memuat angka dan/atau tanda baca',
            'alamat_detail.required'  => 'Alamat Detail tidak boleh kosong',
            'alamat_detail.string'    => 'Alamat Detail harus berupa karakter',
            'alamat_detail.regex'     => 'Alamat Detail tidak boleh memuat tanda baca selain titik',
        ];
    }
}
