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

            'w_event_id'  => 'required|exists:w_events,id',
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
            'groom.required'   => 'Nama pengantin pria tidak boleh kosong',
            'groom.string'     => 'Nama pengantin pria harus berupa karakter',
            'groom.regex'      => 'Nama pengantin pria tidak boleh memuat angka dan/atau tanda baca',

            'bride.required'   => 'Nama pengantin wanita tidak boleh kosong',
            'bride.string'     => 'Nama pengantin wanita harus berupa karakter',
            'bride.regex'      => 'Nama pengantin wanita tidak boleh memuat angka dan/atau tanda baca',

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
