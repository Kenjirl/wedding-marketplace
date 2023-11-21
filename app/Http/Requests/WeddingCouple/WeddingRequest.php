<?php

namespace App\Http\Requests\WeddingCouple;

use Illuminate\Foundation\Http\FormRequest;

class WeddingRequest extends FormRequest
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
            'groom'    =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'bride'    =>'required|string|regex:/^[a-zA-Z\s]*$/',

            'waktu_pemberkatan'     =>'required',
            'provinsi_pemberkatan'  =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'kota_pemberkatan'      =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'kecamatan_pemberkatan' =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'kelurahan_pemberkatan' =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'alamat_pemberkatan'    =>'required|string|regex:/^[a-zA-Z\s.0-9]*$/',

            'waktu_perayaan'     =>'required',
            'provinsi_perayaan'  =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'kota_perayaan'      =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'kecamatan_perayaan' =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'kelurahan_perayaan' =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'alamat_perayaan'    =>'required|string|regex:/^[a-zA-Z\s.0-9]*$/',
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
            'groom.required'   => 'Nama pengantin pria tidak boleh kosong',
            'groom.string'     => 'Nama pengantin pria harus berupa karakter',
            'groom.regex'      => 'Nama pengantin pria tidak boleh memuat angka dan/atau tanda baca',

            'bride.required'   => 'Nama pengantin wanita tidak boleh kosong',
            'bride.string'     => 'Nama pengantin wanita harus berupa karakter',
            'bride.regex'      => 'Nama pengantin wanita tidak boleh memuat angka dan/atau tanda baca',

            'waktu_pemberkatan.required'    => 'Waktu pemberkatan tidak boleh kosong',
            'provinsi_pemberkatan.required' => 'Provinsi pemberkatan tidak boleh kosong',
            'provinsi_pemberkatan.string'   => 'Provinsi pemberkatan harus berupa karakter',
            'provinsi_pemberkatan.regex'    => 'Provinsi pemberkatan tidak boleh memuat angka dan/atau tanda baca',
            'kota_pemberkatan.required'     => 'Kota pemberkatan tidak boleh kosong',
            'kota_pemberkatan.string'       => 'Kota pemberkatan harus berupa karakter',
            'kota_pemberkatan.regex'        => 'Kota pemberkatan tidak boleh memuat angka dan/atau tanda baca',
            'kecamatan_pemberkatan.required'=> 'Kecamatan pemberkatan tidak boleh kosong',
            'kecamatan_pemberkatan.string'  => 'Kecamatan pemberkatan harus berupa karakter',
            'kecamatan_pemberkatan.regex'   => 'Kecamatan pemberkatan tidak boleh memuat angka dan/atau tanda baca',
            'kelurahan_pemberkatan.required'=> 'Kelurahan pemberkatan tidak boleh kosong',
            'kelurahan_pemberkatan.string'  => 'Kelurahan pemberkatan harus berupa karakter',
            'kelurahan_pemberkatan.regex'   => 'Kelurahan pemberkatan tidak boleh memuat angka dan/atau tanda baca',
            'alamat_pemberkatan.required'   => 'Alamat pemberkatan tidak boleh kosong',
            'alamat_pemberkatan.string'     => 'Alamat pemberkatan harus berupa karakter',
            'alamat_pemberkatan.regex'      => 'Alamat pemberkatan tidak boleh memuat tanda baca selain titik',

            'waktu_perayaan.required'    => 'Waktu perayaan tidak boleh kosong',
            'provinsi_perayaan.required' => 'Provinsi perayaan tidak boleh kosong',
            'provinsi_perayaan.string'   => 'Provinsi perayaan harus berupa karakter',
            'provinsi_perayaan.regex'    => 'Provinsi perayaan tidak boleh memuat angka dan/atau tanda baca',
            'kota_perayaan.required'     => 'Kota perayaan tidak boleh kosong',
            'kota_perayaan.string'       => 'Kota perayaan harus berupa karakter',
            'kota_perayaan.regex'        => 'Kota perayaan tidak boleh memuat angka dan/atau tanda baca',
            'kecamatan_perayaan.required'=> 'Kecamatan perayaan tidak boleh kosong',
            'kecamatan_perayaan.string'  => 'Kecamatan perayaan harus berupa karakter',
            'kecamatan_perayaan.regex'   => 'Kecamatan perayaan tidak boleh memuat angka dan/atau tanda baca',
            'kelurahan_perayaan.required'=> 'Kelurahan perayaan tidak boleh kosong',
            'kelurahan_perayaan.string'  => 'Kelurahan perayaan harus berupa karakter',
            'kelurahan_perayaan.regex'   => 'Kelurahan perayaan tidak boleh memuat angka dan/atau tanda baca',
            'alamat_perayaan.required'   => 'Alamat perayaan tidak boleh kosong',
            'alamat_perayaan.string'     => 'Alamat perayaan harus berupa karakter',
            'alamat_perayaan.regex'      => 'Alamat perayaan tidak boleh memuat tanda baca selain titik',
        ];
    }
}
