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
        <table class="w-full table-auto cell-border compact hover" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-2">
                        {{ $event->nama }}
                    </td>
                    <td class="px-2">
                        {{ $event->jenis }}
                    </td>
                    <td class="px-2">
                        <div class="line-clamp-1">
                            {!! $event->keterangan !!}
                        </div>
                    </td>
                    <td class="flex flex-nowrap items-center justify-center gap-2 p-2">
                        <a class="flex-1 w-full text-center whitespace-nowrap text-sm font-semibold px-4 py-2 outline-none hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active
                            {{ $event->id === 1 ? 'text-white bg-slate-300 pointer-events-none cursor-not-allowed' : 'text-pink bg-white' }}
                            transition-colors rounded"
                            href="{{ route('admin.event-pernikahan.ke_ubah', $event->id) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <form class="flex-1 w-full"
                            action="{{ route('admin.event-pernikahan.hapus', $event->id) }}" method="post" id="deleteForm-{{ $event->id }}">
                            @csrf
                            <button class="w-full px-4 py-2 rounded text-sm whitespace-nowrap text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 disabled:bg-slate-300 disabled:cursor-not-allowed transition-colors"
                                {{ $event->id === 1 ? 'disabled' : '' }}
                                type="button" onclick="showDeleteConfirmation({{ $event->id }}, '{{ $event->nama }}')">
                                <i class="fa-solid fa-trash-can"></i>
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
