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
            'p_lengkap' =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'p_sapaan'  =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'p_ayah'    =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'p_ibu'     =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'w_lengkap' =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'w_sapaan'  =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'w_ayah'    =>'required|string|regex:/^[a-zA-Z\s]*$/',
            'w_ibu'     =>'required|string|regex:/^[a-zA-Z\s]*$/',

            'w_event_id'  => 'required|exists:m_events,id',
            // 'waktu.*'     => 'required|date_format:Y-m-d H:i:s|after:' . date(DATE_ATOM),
            'waktu.*'     => 'required|after:' . date('Y-m-d'),
            'provinsi.*'  => 'required|string|regex:/^[a-zA-Z\s]*$/',
            'kota.*'      => 'required|string|regex:/^[a-zA-Z\s]*$/',
            'kecamatan.*' => 'required|string|regex:/^[a-zA-Z\s]*$/',
            'kelurahan.*' => 'required|string|regex:/^[a-zA-Z\s]*$/',
            'alamat.*'    => 'required|string|regex:/^[a-zA-Z\s.0-9]*$/',
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
            'p_lengkap.required' => 'Nama lengkap pengantin pria tidak boleh kosong',
            'p_lengkap.string'   => 'Nama lengkap pengantin pria harus berupa karakter',
            'p_lengkap.regex'    => 'Nama lengkap pengantin pria tidak boleh memuat angka dan/atau tanda baca',
            'p_sapaan.required'  => 'Nama sapaan pengantin pria tidak boleh kosong',
            'p_sapaan.string'    => 'Nama sapaan pengantin pria harus berupa karakter',
            'p_sapaan.regex'     => 'Nama sapaan pengantin pria tidak boleh memuat angka dan/atau tanda baca',
            'p_ayah.required'    => 'Nama ayah pengantin pria tidak boleh kosong',
            'p_ayah.string'      => 'Nama ayah pengantin pria harus berupa karakter',
            'p_ayah.regex'       => 'Nama ayah pengantin pria tidak boleh memuat angka dan/atau tanda baca',
            'p_ibu.required'     => 'Nama ibu pengantin pria tidak boleh kosong',
            'p_ibu.string'       => 'Nama ibu pengantin pria harus berupa karakter',
            'p_ibu.regex'        => 'Nama ibu pengantin pria tidak boleh memuat angka dan/atau tanda baca',

            'w_lengkap.required' => 'Nama lengkap pengantin wanita tidak boleh kosong',
            'w_lengkap.string'   => 'Nama lengkap pengantin wanita harus berupa karakter',
            'w_lengkap.regex'    => 'Nama lengkap pengantin wanita tidak boleh memuat angka dan/atau tanda baca',
            'w_sapaan.required'  => 'Nama sapaan pengantin wanita tidak boleh kosong',
            'w_sapaan.string'    => 'Nama sapaan pengantin wanita harus berupa karakter',
            'w_sapaan.regex'     => 'Nama sapaan pengantin wanita tidak boleh memuat angka dan/atau tanda baca',
            'w_ayah.required'    => 'Nama ayah pengantin wanita tidak boleh kosong',
            'w_ayah.string'      => 'Nama ayah pengantin wanita harus berupa karakter',
            'w_ayah.regex'       => 'Nama ayah pengantin wanita tidak boleh memuat angka dan/atau tanda baca',
            'w_ibu.required'     => 'Nama ibu pengantin wanita tidak boleh kosong',
            'w_ibu.string'       => 'Nama ibu pengantin wanita harus berupa karakter',
            'w_ibu.regex'        => 'Nama ibu pengantin wanita tidak boleh memuat angka dan/atau tanda baca',

            'w_event_id.*.required' => 'ID Event tidak boleh kosong',
            'w_event_id.*.exists'   => 'ID Event harus valid',
            'waktu.*.required'      => 'Waktu acara tidak boleh kosong',
            // 'waktu.*.date_format'   => 'Waktu acara harus menggunakan format waktu dan tanggal yang benar',
            'waktu.*.after'         => 'Waktu acara tidak boleh tanggal sebelum hari ini',
            'provinsi.*.required'   => 'Provinsi acara tidak boleh kosong',
            'provinsi.*.string'     => 'Provinsi acara harus berupa karakter',
            'provinsi.*.regex'      => 'Provinsi acara tidak boleh memuat angka dan/atau tanda baca',
            'kota.*.required'       => 'Kota acara tidak boleh kosong',
            'kota.*.string'         => 'Kota acara harus berupa karakter',
            'kota.*.regex'          => 'Kota acara tidak boleh memuat angka dan/atau tanda baca',
            'kecamatan.*.required'  => 'Kecamatan acara tidak boleh kosong',
            'kecamatan.*.string'    => 'Kecamatan acara harus berupa karakter',
            'kecamatan.*.regex'     => 'Kecamatan acara tidak boleh memuat angka dan/atau tanda baca',
            'kelurahan.*.required'  => 'Kelurahan acara tidak boleh kosong',
            'kelurahan.*.string'    => 'Kelurahan acara harus berupa karakter',
            'kelurahan.*.regex'     => 'Kelurahan acara tidak boleh memuat angka dan/atau tanda baca',
            'alamat.*.required'     => 'Alamat acara tidak boleh kosong',
            'alamat.*.string'       => 'Alamat acara harus berupa karakter',
            'alamat.*.regex'        => 'Alamat acara tidak boleh memuat tanda baca selain titik',
        ];
    }
}
