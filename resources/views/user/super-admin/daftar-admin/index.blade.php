@extends('user.super-admin.layout')

@section('title')
    <title>Daftar Admin | Wedding Marketplace</title>
@endsection

@section('h1', 'Daftar Admin')

@section('content')
    <div class="w-full mb-4 flex items-center justify-end">
        <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
            href="{{ route('super-admin.daftar-admin.ke_tambah') }}">
            <i class="fa-solid fa-plus"></i>
            Tambah Admin
        </a>
    </div>

    <div class="w-full">
        <table class="w-full table-auto cell-border compact hover" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($admins as $admin)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
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
                        <a class="text-center text-sm font-semibold px-4 py-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                            href="{{ route('super-admin.daftar-admin.ke_ubah', $admin->id) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                            {{-- Ubah --}}
                        </a>
                        <form class=""
                            action="{{ route('super-admin.daftar-admin.hapus', $admin->id) }}" method="post" id="deleteForm-{{ $admin->id }}">
                            @csrf
                            <button class="w-fit px-4 py-2 rounded text-sm text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                                type="button" onclick="showDeleteConfirmation({{ $admin->id }})">
                                <i class="fa-solid fa-trash-can"></i>
                                {{-- Hapus --}}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-center">Belum ada Data</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('child-js')
    <script>
        function showDeleteConfirmation(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data Admin ini?')) {
                const formId = 'deleteForm-' + id;
                const deleteForm = document.getElementById(formId);

                if (deleteForm) {
                    deleteForm.submit();
                }
            } else {
            }
        }
    </script>
@endpush
