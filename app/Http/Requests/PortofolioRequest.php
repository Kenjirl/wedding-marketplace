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
            'judul'         => 'required|string|max:100',
            'tanggal'       => 'required|date|before_or_equal:' . date('Y-m-d'),
            'detail'        => 'required',
            'provinsi'      => 'required|string|regex:/^[a-zA-Z\s()]*$/',
            'kota'          => 'required|string|regex:/^[a-zA-Z\s()]*$/',
            'kecamatan'     => 'required|string|regex:/^[a-zA-Z\s()]*$/',
            'kelurahan'     => 'required|string|regex:/^[a-zA-Z\s()]*$/',
            'alamat_detail' => 'required|string|regex:/^[a-zA-Z\s.0-9]*$/',
            'form-info'     => 'required|in:add,edit',
            'foto'          => 'required_if:form-info,add|array|min:1|max:5',
            'foto.*'        => 'image',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required'          => 'Judul tidak boleh kosong',
            'judul.string'            => 'Judul harus berupa karakter',
            'judul.max'               => 'Judul tidak boleh lebih dari 100 karakter',
            'tanggal.required'        => 'Tanggal Portofolio tidak boleh kosong',
            'tanggal.date'            => 'Tanggal Portofolio harus menggunakan format tanggal yang benar',
            'tanggal.before_or_equal' => 'Tanggal Portofolio tidak boleh setelah atau sama dengan tanggal hari ini',
            'detail.required'         => 'Detail tidak boleh kosong',
            'provinsi.required'       => 'Provinsi tidak boleh kosong',
            'provinsi.string'         => 'Provinsi harus berupa karakter',
            'provinsi.regex'          => 'Provinsi harus dipilih dari pilihan yang tersedia',
            'kota.required'           => 'Kota tidak boleh kosong',
            'kota.string'             => 'Kota harus berupa karakter',
            'kota.regex'              => 'Kota harus dipilih dari pilihan yang tersedia',
            'kecamatan.required'      => 'Kecamatan tidak boleh kosong',
            'kecamatan.string'        => 'Kecamatan harus berupa karakter',
            'kecamatan.regex'         => 'Kecamatan harus dipilih dari pilihan yang tersedia',
            'kelurahan.required'      => 'Kelurahan tidak boleh kosong',
            'kelurahan.string'        => 'Kelurahan harus berupa karakter',
            'kelurahan.regex'         => 'Kelurahan harus dipilih dari pilihan yang tersedia',
            'alamat_detail.required'  => 'Alamat Detail tidak boleh kosong',
            'alamat_detail.string'    => 'Alamat Detail harus berupa karakter',
            'alamat_detail.regex'     => 'Alamat Detail tidak boleh memuat tanda baca selain titik',
            'foto.required_if'        => 'Minimal satu gambar harus diunggah.',
            'foto.array'              => 'Foto harus berupa array.',
            'foto.min'                => 'Minimal satu gambar harus diunggah asdasd.',
            'foto.max'                => 'Maksimal lima gambar yang boleh diunggah.',
            'foto.*.image'            => 'Setiap file harus berupa gambar.',
        ];
    }
}
