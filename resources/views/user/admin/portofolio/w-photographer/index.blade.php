@extends('user.admin.layout')

@section('title')
    <title>Portofolio | Wedding Marketplace</title>
@endsection

@section('h1', 'Portofolio')

@section('content')
    {{-- ATAS --}}
    <div class="w-full flex items-center justify-between">
        {{-- TOMBOL TAB --}}
        <div class="w-fit flex items-stretch justify-start">
            <a class="block w-fit px-4 py-2 font-semibold outline-none rounded-t {{ $tab == 'pending' ? 'bg-yellow-300 text-white' : '' }} hover:bg-yellow-300 hover:text-white focus:bg-yellow-300 focus:text-white active:bg-yellow-400 transition-colors"
                href="{{ route('admin.wp.portofolio.index', 'pending') }}" data-tippy-content="Menunggu Konfirmasi">
                <i class="fa-regular fa-clock"></i>
            </a>
            <a class="block w-fit px-4 py-2 font-semibold outline-none rounded-t {{ $tab == 'accept' ? 'bg-blue-300 text-white' : '' }} hover:bg-blue-300 hover:text-white focus:bg-blue-300 focus:text-white active:bg-blue-400 transition-colors"
                href="{{ route('admin.wp.portofolio.index', 'accept') }}" data-tippy-content="Diterima">
                <i class="fa-regular fa-circle-check"></i>
            </a>
            <a class="block w-fit px-4 py-2 font-semibold outline-none rounded-t {{ $tab == 'reject' ? 'bg-red-300 text-white' : '' }} hover:bg-red-300 hover:text-white focus:bg-red-300 focus:text-white active:bg-red-400 transition-colors"
                href="{{ route('admin.wp.portofolio.index', 'reject') }}" data-tippy-content="Ditolak">
                <i class="fa-regular fa-circle-xmark"></i>
            </a>
        </div>

        {{-- CONFIG --}}
        <form action="{{ route('admin.wp.portofolio.config') }}" method="post" id="configForm">
            @csrf
            <label class="relative inline-flex items-center mb-5 cursor-pointer">
                <input name="config" id="config" type="checkbox" class="sr-only peer"
                    {{ $config->automation ? 'checked' : '' }}
                >
                <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-pink-hover peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-pink"></div>
                <span class="ms-3 text-sm font-medium text-gray-900">Auto Confirm?</span>
            </label>
        </form>
    </div>

    {{-- BAWAH --}}
    @if ($tab == 'accept')
        <div class="w-full rounded-b border border-blue-300 shadow">
    @elseif ($tab == 'reject')
        <div class="w-full rounded-b border border-red-300 shadow">
    @else
        <div class="w-full rounded-b border border-yellow-300 shadow">
    @endif

        <div class="p-4">
            <table class="w-full table-auto cell-border compact hover" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pembuat</th>
                        <th>Dibuat Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($portofolio as $prt)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-2">
                            <div class="line-clamp-1">
                                {{ $prt->judul }}
                            </div>
                        </td>
                        <td class="px-2">
                            <div class="line-clamp-1">
                                {{ $prt->w_photographer->nama }}
                            </div>
                        </td>
                        <td class="px-2 text-end">
                            {{ $prt->updated_at }}
                        </td>
                        <td class="p-2">
                            <a class="block text-center whitespace-nowrap text-sm font-semibold py-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                href="{{ route('admin.wp.portofolio.ke_validasi', $prt->id) }}">
                                <i class="fa-regular fa-pen-to-square"></i>
                                {{-- Lihat Detail --}}
                            </a>
                        </td>
                    </tr>
                    @empty
                        {{-- NO DATA --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('child-js')
    <script>
        $(document).ready(function () {
            $("#config").on("change", function () {
                let confirmed = confirm('Apakah Anda yakin ingin membuat portofolio photographer tidak memerlukan validasi?');
                if (confirmed) {
                    $("#configForm").submit();
                } else {
                    $(this).prop("checked", !$(this).prop("checked"));
                }
            });
        });
    </script>
@endpush
