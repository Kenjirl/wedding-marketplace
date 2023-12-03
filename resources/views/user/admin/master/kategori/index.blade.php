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
        <table class="w-full table-auto cell-border compact hover" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $wkg)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-2">
                        {{ $wkg->nama }}
                    </td>
                    <td class="px-2">
                        <div class="line-clamp-1">
                            {!! $wkg->keterangan !!}
                        </div>
                    </td>
                    <td class="h-full flex flex-nowrap items-center justify-center gap-2 p-2">
                        <a class="flex-1 w-full text-center whitespace-nowrap text-sm font-semibold px-4 py-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                            href="{{ route('admin.kategori-pernikahan.ke_ubah', $wkg->id) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                            {{-- Ubah --}}
                        </a>
                        <form class="flex-1 w-full"
                            action="{{ route('admin.kategori-pernikahan.hapus', $wkg->id) }}" method="post" id="deleteForm-{{ $wkg->id }}">
                            @csrf
                            <button class="w-full px-4 py-2 rounded text-sm whitespace-nowrap text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                                type="button" onclick="showDeleteConfirmation({{ $wkg->id }})">
                                <i class="fa-solid fa-trash-can"></i>
                                {{-- Hapus --}}
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
@endsection

@push('child-js')
    <script>
        function showDeleteConfirmation(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data kategori ini?')) {
                const formId = 'deleteForm-' + id;
                const deleteForm = document.getElementById(formId);

                if (deleteForm) {
                    deleteForm.submit();
                } else {
                }
            }
        }
    </script>
@endpush
