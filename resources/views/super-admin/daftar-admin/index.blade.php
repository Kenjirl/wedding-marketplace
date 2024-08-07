@extends('super-admin.layout')

@section('title')
    <title>Daftar Admin | Wedding Marketplace</title>
@endsection

@section('h1', 'Daftar Admin')

@section('content')
    <div class="w-full flex items-center justify-end">
        <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
            href="{{ route('super-admin.daftar-admin.ke_tambah') }}">
            <i class="fa-solid fa-plus"></i>
            Tambah Admin
        </a>
    </div>

    <hr class="my-4">

    <div class="w-full">
        <table class="w-full table-auto cell-border compact hover" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Waktu</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $is_allowed = count($admins) > 1 ? true : false;
                @endphp
                @forelse ($admins as $admin)
                <tr class="border-b">
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-2">
                        {{ $admin->updated_at }}
                    </td>
                    <td class="px-2">
                        {{ $admin->nama }}
                    </td>
                    <td class="px-2">
                        {{ $admin->user->email }}
                    </td>
                    <td class="px-2">
                        {{ $admin->user->name }}
                    </td>
                    <td class="flex items-center justify-center gap-2 p-2">
                        <a class="text-center text-sm font-semibold px-4 py-2 outline-none {{ $is_allowed? 'text-pink bg-white' : 'bg-slate-400 text-white pointer-events-none' }} hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                            href="{{ $is_allowed ? route('super-admin.daftar-admin.ke_ubah', $admin->id) : '#' }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                            {{-- Ubah --}}
                        </a>
                        <form action="{{ $is_allowed ? route('super-admin.daftar-admin.hapus', $admin->id) : '#' }}" method="post" id="deleteForm-{{ $admin->id }}">
                            @csrf
                            <button class="w-fit px-4 py-2 rounded text-sm text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 disabled:bg-slate-400 transition-colors"
                                type="button" onclick="showDeleteConfirmation({{ $admin->id }}, '{{ $admin->nama }}')" {{ $is_allowed?: 'disabled' }}>
                                <i class="fa-solid fa-trash-can"></i>
                                {{-- Hapus --}}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty

                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('child-js')
    <script>
        function showDeleteConfirmation(id, nama) {
            Swal.fire({
                title: `Hapus data Admin ${nama}?`,
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
