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
            'judul'     => 'required|string|max:100',
            'j_vendor'  => 'required|exists:m_jenis_vendors,id',
            'tanggal'   => 'required|date|before_or_equal:' . date('Y-m-d'),
            'detail'    => 'required',
            'lokasi'    => 'required|string',
            'lat'       => 'nullable',
            'lng'       => 'nullable',
            'form-info' => 'required|in:add,edit',
            'foto'      => 'required_if:form-info,add|array|min:1|max:5',
            'foto.*'    => 'image',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required'          => 'Judul tidak boleh kosong',
            'judul.string'            => 'Judul harus berupa karakter',
            'judul.max'               => 'Judul tidak boleh lebih dari 100 karakter',
            'j_vendor.required'       => 'Jenis Vendor tidak boleh kosong',
            'j_vendor.exists'         => 'Jenis Vendor tidak tersedia',
            'tanggal.required'        => 'Tanggal Portofolio tidak boleh kosong',
            'tanggal.date'            => 'Tanggal Portofolio harus menggunakan format tanggal yang benar',
            'tanggal.before_or_equal' => 'Tanggal Portofolio tidak boleh setelah atau sama dengan tanggal hari ini',
            'detail.required'         => 'Detail tidak boleh kosong',
            'lokasi.required'         => 'Lokasi tidak boleh kosong',
            'lokasi.string'           => 'Alamat Detail harus berupa karakter',
            'foto.required_if'        => 'Minimal satu gambar harus diunggah.',
            'foto.array'              => 'Foto harus berupa array.',
            'foto.min'                => 'Minimal satu gambar harus diunggah asdasd.',
            'foto.max'                => 'Maksimal lima gambar yang boleh diunggah.',
            'foto.*.image'            => 'Setiap file harus berupa gambar.',
        ];
    }
}
