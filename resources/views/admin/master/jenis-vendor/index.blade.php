@extends('admin.layout')

@section('title')
    <title>Jenis Vendor | Wedding Marketplace</title>
@endsection

@section('h1', 'Jenis Vendor')

@section('content')
    <div class="w-full mb-4 flex items-center justify-end">
        <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
            href="{{ route('admin.jenis-vendor.ke_tambah') }}">
            <i class="fa-solid fa-plus"></i>
            Tambah Jenis Vendor
        </a>
    </div>

    <hr class="my-4">

    <table class="w-full display table-auto cell-border compact hover" id="dataTable">
        <thead>
            <tr class="border-t">
                <th class="w-fit">No</th>
                <th>Kategori</th>
                <th>Icon (Teks)</th>
                <th>Icon (Model)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $is_allowed = count($j_vendors) > 1 ? true : false;
            @endphp
            @forelse ($j_vendors as $j_vendor)
                <tr class="border-b">
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-2">
                        {{ $j_vendor->nama }}
                    </td>
                    <td class="px-2">
                        {{ $j_vendor->icon }}
                    </td>
                    <td class="px-2 text-center">
                        <i class="{{ $j_vendor->icon }}"></i>
                    </td>
                    <td class="flex flex-nowrap items-center justify-center gap-2 p-2">
                        <a class="block w-fit text-center whitespace-nowrap text-sm font-semibold px-4 py-2 outline-none {{ $is_allowed? 'text-pink' : 'bg-slate-400 text-white pointer-events-none' }} hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                            href="{{ $is_allowed ? route('admin.jenis-vendor.ke_ubah', $j_vendor->id) : '#' }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <form action="{{ $is_allowed ? route('admin.jenis-vendor.hapus', $j_vendor->id) : '#' }}" method="post" id="deleteForm-{{ $j_vendor->id }}">
                            @csrf
                            <button class="w-fit px-4 py-2 rounded text-sm whitespace-nowrap text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 disabled:bg-slate-400 transition-colors"
                                type="button" onclick="showDeleteConfirmation({{ $j_vendor->id }}, '{{ $j_vendor->nama }}')" {{ $is_allowed?: 'disabled' }}>
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="border-b text-center">
                    <td class="p-2">Belum ada data</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

@push('child-js')
    <script>
        function showDeleteConfirmation(id, nama) {
            Swal.fire({
                title: `Hapus data Kategori ${nama}?`,
                text: "Data tidak akan dapat dikembalikan lagi",
                icon: "warning",
                iconColor: "#F78CA2",
                showCloseButton: true,
                confirmButtonColor: "#F78CA2",
                confirmButtonText: "Konfirmasi"
            }).then((result) => {
                if (result.isConfirmed) {
                    const formId = 'deleteForm-' + id;
                    const deleteForm = document.getElementById(formId);

                    if (deleteForm) {
                        deleteForm.submit();
                    }
                }
            });
        }
    </script>
@endpush
