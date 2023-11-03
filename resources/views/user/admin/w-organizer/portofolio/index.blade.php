@extends('user.admin.layout')

@section('title')
    <title>Portofolio | Wedding Marketplace</title>
@endsection

@section('h1', 'Portofolio')

@section('content')
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
                        <th class="border border-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pending as $pdg)
                    <tr>
                        <td class="border border-slate-500 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-slate-500 px-2">
                            {{ $pdg->judul }}
                        </td>
                        <td class="border border-slate-500 px-2">
                            {{ $pdg->w_organizer->nama_perusahaan }}
                        </td>
                        <td class="border-b border-slate-500 flex items-center justify-evenly gap-2 p-2">
                            <a class="flex-1 text-center text-sm font-semibold py-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                href="{{ route('admin.wo.portofolio.ke_validasi', $pdg->id) }}">
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
                        <th class="border border-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accepted as $acc)
                    <tr>
                        <td class="border border-slate-500 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-slate-500 px-2">
                            {{ $acc->judul }}
                        </td>
                        <td class="border border-slate-500 px-2">
                            {{ $acc->w_organizer->nama_perusahaan }}
                        </td>
                        <td class="border border-slate-500 px-2">
                            {{ $acc->admin->nama }}
                        </td>
                        <td class="border-b border-slate-500 flex items-center justify-evenly gap-2 p-2">
                            <a class="flex-1 text-center text-sm font-semibold py-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                href="{{ route('admin.wo.portofolio.ke_validasi', $acc->id) }}">
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
                        <th class="border border-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rejected as $rej)
                    <tr>
                        <td class="border border-slate-500 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-slate-500 px-2">
                            {{ $rej->judul }}
                        </td>
                        <td class="border border-slate-500 px-2">
                            {{ $rej->w_organizer->nama_perusahaan }}
                        </td>
                        <td class="border border-slate-500 px-2">
                            {{ $rej->admin->nama }}
                        </td>
                        <td class="border-b border-slate-500 flex items-center justify-evenly gap-2 p-2">
                            <a class="flex-1 text-center text-sm font-semibold py-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                href="{{ route('admin.wo.portofolio.ke_validasi', $rej->id) }}">
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

@endsection
