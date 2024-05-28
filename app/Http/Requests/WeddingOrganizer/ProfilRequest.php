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
            'nama'   =>'required|string|regex:/^[a-zA-Z\s]*$/|max:50',
            'username'       =>[
                'required',
                Rule::unique('users', 'name')->ignore(auth()->id()),
            ],
            'no_telp'        =>'required|string|min:8|max:12',
            'basis_operasi'  =>'required|string|regex:/^[a-zA-Z\s]*$/|in:Hanya di Dalam Kota,Bisa ke Luar Kota',
            'kota_operasi'   =>'string|regex:/^[a-zA-Z\s]*$/',
            'rekening' => ['required', 'array', function ($attribute, $value, $fail) {
                $filled = array_filter($value, function($item) {
                    return !empty($item);
                });
                if (count($filled) < 1) {
                    $fail('Minimal harus memiliki satu nomor rekening.');
                }
            }],
            'rekening.*'     => ['nullable'],
            'provinsi'       =>'required|string|regex:/^[a-zA-Z\s()]*$/',
            'kota'           =>'required|string|regex:/^[a-zA-Z\s()]*$/',
            'kecamatan'      =>'required|string|regex:/^[a-zA-Z\s()]*$/',
            'kelurahan'      =>'required|string|regex:/^[a-zA-Z\s()]*$/',
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
            'nama.required'           => 'Nama tidak boleh kosong',
            'nama.string'             => 'Nama harus berupa karakter',
            'nama.regex'              => 'Nama tidak boleh memuat angka dan/atau tanda baca',
            'nama.max'                => 'Nama tidak boleh lebih dari 50 karakter',
            'username.required'       => 'Username tidak boleh kosong',
            'username.unique'         => 'Username sudah digunakan',
            'no_telp.required'        => 'Nomor Telepon tidak boleh kosong',
            'no_telp.string'          => 'Nomor Telepon harus berupa angka',
            'no_telp.min'             => 'Nomor Telepon minimal 8 karakter',
            'no_telp.max'             => 'Nomor Telepon maksimal 12 karakter',
            'basis_operasi.required'  => 'Basis Operasi tidak boleh kosong',
            'basis_operasi.string'    => 'Basis Operasi harus berupa karakter',
            'basis_operasi.regex'     => 'Basis Operasi harus dipilih dari pilihan yang tersedia',
            'basis_operasi.in'        => 'Basis Operasi harus dipilih dari pilihan yang tersedia',
            'kota_operasi.string'     => 'Kota Operasi harus berupa karakter',
            'kota_operasi.regex'      => 'Kota Operasi harus dipilih dari pilihan yang tersedia',
            'rekening.required'       => 'Harus memiliki minimal 1 informasi rekening',
            'rekening.array'          => 'Rekening harus berupa array',
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
        ];
    }
}
