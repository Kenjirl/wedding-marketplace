@extends('user.admin.layout')

@section('title')
    <title>Event Pernikahan | Wedding Marketplace</title>
@endsection

@section('h1', 'Event Pernikahan')

@section('content')
    <div class="w-full mb-4 flex items-center justify-end">
        <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
            href="{{ route('admin.event-pernikahan.ke_tambah') }}">
            <i class="fa-solid fa-plus"></i>
            Tambah Event
        </a>
    </div>

    <div class="w-full">
        <table class="w-full table-auto border-collapse border border-slate-500">
            <thead>
                <tr>
                    <th class="border border-slate-500">No</th>
                    <th class="border border-slate-500">Kategori</th>
                    <th class="border border-slate-500">Jenis</th>
                    <th class="border border-slate-500">Keterangan</th>
                    <th class="border border-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                <tr>
                    <td class="border border-slate-500 text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="border border-slate-500 px-2">
                        {{ $event->nama }}
                    </td>
                    <td class="border border-slate-500 px-2">
                        {{ $event->jenis }}
                    </td>
                    <td class="border border-slate-500 px-2">
                        <div class="line-clamp-1">
                            {!! $event->keterangan !!}
                        </div>
                    </td>
                    <td class="border-b border-slate-500 flex flex-nowrap items-center justify-center gap-2 p-2">
                        <a class="flex-1 w-full text-center whitespace-nowrap text-sm font-semibold p-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                            href="{{ route('admin.event-pernikahan.ke_ubah', $event->id) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Ubah
                        </a>
                        <form class="flex-1 w-full"
                            action="{{ route('admin.event-pernikahan.hapus', $event->id) }}" method="post" id="deleteForm-{{ $event->id }}">
                            @csrf
                            <button class="w-full p-2 rounded text-sm whitespace-nowrap text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                                type="button" onclick="showDeleteConfirmation({{ $event->id }})">
                                <i class="fa-solid fa-trash-can"></i>
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-center">Belum ada data</td=>
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
            if (confirm('Apakah Anda yakin ingin menghapus data event ini?')) {
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
