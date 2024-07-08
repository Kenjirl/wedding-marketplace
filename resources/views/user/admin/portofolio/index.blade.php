@extends('user.admin.layout')

@section('title')
    <title>Portofolio | Wedding Marketplace</title>
@endsection

@section('h1', 'Portofolio')

@section('content')
    @php
        $vendors = [
            'wedding-organizer' => ['name' => 'Organizer', 'icon' => 'fa-regular fa-building'],
            'photographer' => ['name' => 'Photographer', 'icon' => 'fa-solid fa-camera-retro'],
            'catering' => ['name' => 'Catering', 'icon' => 'fa-solid fa-utensils'],
            'venue' => ['name' => 'Venue', 'icon' => 'fa-solid fa-place-of-worship']
        ];
        $statuses = [
            'pending' => ['name' => 'Menunggu Konfirmasi', 'color' => 'yellow', 'icon' => 'fa-regular fa-clock'],
            'accept' => ['name' => 'Diterima', 'color' => 'blue', 'icon' => 'fa-regular fa-circle-check'],
            'reject' => ['name' => 'Ditolak', 'color' => 'red', 'icon' => 'fa-regular fa-circle-xmark']
        ];
    @endphp

    {{-- ATAS --}}
    <div class="w-full flex items-center justify-between">
        {{-- CHANGE STATUS --}}
        <div class="w-fit flex items-stretch justify-start">
            @foreach($statuses as $key => $status)
                <a class="block w-fit px-4 py-2 font-semibold outline-none rounded-t {{ $tab == $key ? 'bg-' . $status['color'] . '-400 text-white' : '' }} hover:bg-{{ $status['color'] }}-400 hover:text-white focus:bg-{{ $status['color'] }}-400 focus:text-white active:bg-{{ $status['color'] }}-400 transition-colors"
                    href="{{ route('admin.portofolio.index', ['vendor' => $vendor, 'tab' => $key]) }}" data-tippy-content="{{ $status['name'] }}">
                    <i class="{{ $status['icon'] }}"></i>
                </a>
            @endforeach
        </div>

        {{-- CHANGE CONFIG --}}
        <form action="{{ route('admin.portofolio.config', ['vendor' => $vendor]) }}" method="post" id="configForm">
            @csrf
            <input type="hidden" name="vendor" value="{{ $vendor }}">
            <label class="relative inline-flex items-center mb-5 cursor-pointer">
                <input name="config" id="config" type="checkbox" class="sr-only peer"
                    {{ $vendorConfig ? 'checked' : '' }}
                >
                <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-pink-hover peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-400 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-pink"></div>
                <span class="ms-3 text-sm font-medium text-gray-900">Auto Confirm?</span>
            </label>
        </form>
    </div>

    {{-- BAWAH --}}
    <div class="w-full border-t-2 border-{{ $statuses[$tab]['color'] }}-400">
        <div class="p-4">
            <table class="w-full table-auto cell-border compact hover" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pembuat</th>
                        @if ($tab != 'pending')
                            <th>Penanggung Jawab</th>
                        @endif
                        <th>Dibuat Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
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
                                {{ $prt->w_vendor->nama }}
                            </div>
                        </td>
                        @if ($tab != 'pending')
                            <td class="px-2">
                                <div class="line-clamp-1">
                                    {{ $prt->admin->nama }}
                                </div>
                            </td>
                        @endif
                        <td class="px-2 text-end">
                            {{ $prt->updated_at }}
                        </td>
                        <td class="p-2">
                            <a class="block text-center whitespace-nowrap font-semibold px-4 py-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                href="{{ route('admin.portofolio.ke_validasi', ['vendor' => $vendor, 'id' => $prt->id]) }}">
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
                Swal.fire({
                    title: "Aktifkan auto konfirmasi?",
                    text: "Portofolio akan langsung dikonfirmasi dan ditampilkan ke pengguna",
                    icon: "warning",
                    iconColor: "#F78CA2",
                    showCloseButton: true,
                    confirmButtonColor: "#F78CA2",
                    confirmButtonText: "Konfirmasi"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#configForm").submit();
                    } else {
                        $(this).prop("checked", !$(this).prop("checked"));
                    }
                });
            });
        });
    </script>
@endpush
