@extends('user.admin.layout')

@section('title')
    <title>Kategori Pernikahan | Wedding Marketplace</title>
@endsection

@section('h1', 'Kategori Pernikahan')

@section('content')
    <div class="w-full mb-4 flex items-center justify-end">
        <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
            href="{{ route('admin.kategori-pernikahan.ke_tambah') }}">
            <i class="fa-solid fa-plus"></i>
            Tambah Kategori
        </a>
    </div>

    <div class="w-full">
        <table class="w-full table-auto border-collapse border border-slate-500">
            <thead>
                <tr>
                    <th class="border border-slate-500">No</th>
                    <th class="border border-slate-500">Kategori</th>
                    <th class="border border-slate-500">Keterangan</th>
                    <th class="border border-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $wkg)
                <tr>
                    <td class="border border-slate-500 text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="border border-slate-500 px-2">
                        {{ $wkg->nama }}
                    </td>
                    <td class="border border-slate-500 px-2">
                        {!! $wkg->keterangan !!}
                    </td>
                    <td class="border-b border-slate-500 flex flex-col items-stretch justify-center gap-2 p-2">
                        <a class="flex-1 w-full text-center text-sm font-semibold p-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                            href="{{ route('admin.kategori-pernikahan.ke_ubah', $wkg->id) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Ubah
                        </a>
                        <form class="flex-1 w-full"
                            action="{{ route('admin.kategori-pernikahan.hapus', $wkg->id) }}" method="post" id="deleteForm-{{ $wkg->id }}">
                            @csrf
                            <button class="w-full p-2 rounded text-sm text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                                type="button" onclick="showDeleteConfirmation({{ $wkg->id }})">
                                <i class="fa-solid fa-trash-can"></i>
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td></td>
                        <td class="text-end">Belum ada</td>
                        <td class="text-start">Data</td>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function showDeleteConfirmation(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data Admin ini?')) {
                const formId = 'deleteForm-' + id;
                const deleteForm = document.getElementById(formId);

                if (deleteForm) {
                    deleteForm.submit();
                } else {
                }
            }
        }
    </script>
@endsection
