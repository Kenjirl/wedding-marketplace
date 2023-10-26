<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortofolioRequest extends FormRequest
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
            'judul'         => 'required|string',
            'tanggal'       => 'required|date',
            'provinsi'      => 'string|regex:/^[a-zA-Z\s]*$/',
            'kota'          => 'string|regex:/^[a-zA-Z\s]*$/',
            'kecamatan'     => 'string|regex:/^[a-zA-Z\s]*$/',
            'kelurahan'     => 'string|regex:/^[a-zA-Z\s]*$/',
            'alamat_detail' => 'string|regex:/^[a-zA-Z\s.0-9]*$/',
            'foto'          => 'required|image',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required'       => 'Judul tidak boleh kosong',
            'judul.string'         => 'Judul harus berupa karakter',
            'tanggal.required'     => 'Tanggal tidak boleh kosong',
            'tanggal.date'         => 'Tanggal harus menggunakan format tanggal yang benar',
            'provinsi.string'      => 'Provinsi harus berupa karakter',
            'provinsi.regex'       => 'Provinsi tidak boleh memuat angka dan/atau tanda baca',
            'kota.string'          => 'Kota harus berupa karakter',
            'kota.regex'           => 'Kota tidak boleh memuat angka dan/atau tanda baca',
            'kecamatan.string'     => 'Kecamatan harus berupa karakter',
            'kecamatan.regex'      => 'Kecamatan tidak boleh memuat angka dan/atau tanda baca',
            'kelurahan.string'     => 'Kelurahan harus berupa karakter',
            'kelurahan.regex'      => 'Kelurahan tidak boleh memuat angka dan/atau tanda baca',
            'alamat_detail.string' => 'Alamat Detail harus berupa karakter',
            'alamat_detail.regex'  => 'Alamat Detail tidak boleh memuat tanda baca selain titik',
            'foto.required'        => 'Foto tidak boleh kosong',
            'foto.image'           => 'Foto harus berupa gambar',
        ];
    }
}
