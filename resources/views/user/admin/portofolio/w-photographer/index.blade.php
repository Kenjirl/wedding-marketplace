@extends('user.admin.layout')

@section('title')
    <title>Portofolio | Wedding Marketplace</title>
@endsection

@section('h1', 'Portofolio')

@section('content')
    {{-- CONFIG --}}
    <div class="w-full mb-2 text-end">
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

    {{-- PENDING --}}
    <div class="w-full rounded shadow">
        <div class="bg-yellow-100 p-2 font-semibold rounded-t">
            <h2>Menunggu Konfirmasi</h2>
        </div>

        <div class="p-2">
            <table class="w-full table-auto border-collapse border border-slate-500">
                <thead>
                    <tr>
                        <th class="border border-slate-500">No</th>
                        <th class="border border-slate-500">Judul</th>
                        <th class="border border-slate-500">Pembuat</th>
                        <th class="border border-slate-500">Dibuat Pada</th>
                        <th class="border border-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($pending as $pdg)
                    <tr>
                        <td class="border border-slate-500 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-slate-500 px-2">
                            <div class="line-clamp-1">
                                {{ $pdg->judul }}
                            </div>
                        </td>
                        <td class="border border-slate-500 px-2">
                            <div class="line-clamp-1">
                                {{ $pdg->w_photographer->nama }}
                            </div>
                        </td>
                        <td class="border border-slate-500 px-2 text-end">
                            {{ $pdg->updated_at }}
                        </td>
                        <td class="border-b border-slate-500 flex items-center justify-evenly gap-2 p-2">
                            <a class="flex-1 text-center whitespace-nowrap text-sm font-semibold py-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                href="{{ route('admin.wp.portofolio.ke_validasi', $pdg->id) }}">
                                <i class="fa-regular fa-pen-to-square"></i>
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ACCEPTED --}}
    <div class="w-full mt-4 rounded shadow">
        <div class="bg-blue-100 p-2 font-semibold rounded-t">
            <h2>Diterima</h2>
        </div>

        <div class="p-2">
            <table class="w-full table-auto border-collapse border border-slate-500">
                <thead>
                    <tr>
                        <th class="border border-slate-500">No</th>
                        <th class="border border-slate-500">Judul</th>
                        <th class="border border-slate-500">Pembuat</th>
                        <th class="border border-slate-500">Penanggun Jawab</th>
                        <th class="border border-slate-500">Diterima Pada</th>
                        <th class="border border-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($accepted as $acc)
                    <tr>
                        <td class="border border-slate-500 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-slate-500 px-2">
                            <div class="line-clamp-1">
                                {{ $acc->judul }}
                            </div>
                        </td>
                        <td class="border border-slate-500 px-2">
                            <div class="line-clamp-1">
                                {{ $acc->w_photographer->nama }}
                            </div>
                        </td>
                        <td class="border border-slate-500 px-2">
                            <div class="line-clamp-1">
                                {{ $acc->admin->nama }}
                            </div>
                        </td>
                        <td class="border border-slate-500 px-2">
                            {{ $acc->updated_at }}
                        </td>
                        <td class="border-b border-slate-500 flex items-center justify-evenly gap-2 p-2">
                            <a class="flex-1 text-center whitespace-nowrap text-sm font-semibold py-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                href="{{ route('admin.wp.portofolio.ke_validasi', $acc->id) }}">
                                <i class="fa-regular fa-pen-to-square"></i>
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- REJECTED --}}
    <div class="w-full mt-4 rounded shadow">
        <div class="bg-red-100 p-2 font-semibold rounded-t">
            <h2>Ditolak</h2>
        </div>

        <div class="p-2">
            <table class="w-full table-auto border-collapse border border-slate-500">
                <thead>
                    <tr>
                        <th class="border border-slate-500">No</th>
                        <th class="border border-slate-500">Judul</th>
                        <th class="border border-slate-500">Pembuat</th>
                        <th class="border border-slate-500">Penanggun Jawab</th>
                        <th class="border border-slate-500">Ditolak Pada</th>
                        <th class="border border-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($rejected as $rej)
                    <tr>
                        <td class="border border-slate-500 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-slate-500 px-2">
                            <div class="line-clamp-1">
                                {{ $rej->judul }}
                            </div>
                        </td>
                        <td class="border border-slate-500 px-2">
                            <div class="line-clamp-1">
                                {{ $rej->w_photographer->nama }}
                            </div>
                        </td>
                        <td class="border border-slate-500 px-2">
                            <div class="line-clamp-1">
                                {{ $rej->admin->nama }}
                            </div>
                        </td>
                        <td class="border border-slate-500 px-2">
                            {{ $rej->updated_at }}
                        </td>
                        <td class="border-b border-slate-500 flex items-center justify-evenly gap-2 p-2">
                            <a class="flex-1 text-center whitespace-nowrap text-sm font-semibold py-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                href="{{ route('admin.wp.portofolio.ke_validasi', $rej->id) }}">
                                <i class="fa-regular fa-pen-to-square"></i>
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                        </tr>
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
