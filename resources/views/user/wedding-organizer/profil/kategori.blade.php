@extends('user.wedding-organizer.layout')

@section('title')
    <title>Kategori | Wedding Marketplace</title>
@endsection

@section('h1', 'Profil > Kategori')

@section('content')
    {{-- DATA DIRI --}}
    <div class="w-100 flex gap-8">
        <div class="w-full h-fit flex-1 rounded shadow">
            <div class="w-full px-2 py-1 bg-pink text-white font-semibold rounded-t">
                Daftar Kategori
            </div>

            <div class="w-full p-4">
                <div class="w-full p-4 flex flex-wrap items-start justify-normal gap-4 border border-slate-300 rounded-xl">
                    @forelse ($woCategories as $kategori)
                        <div class="flex items-center justify-center">
                            <button class="w-fit px-2 py-1 text-sm text-pink border border-r-0 border-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active outline-none rounded-s-full transition-colors"
                                type="button" onclick="showKeterangan({{ $kategori->id }})">
                                {{ $kategori->w_categories->nama }}
                            </button>
                            <form action="{{ route('wedding-organizer.profil.hapus_kategori', $kategori->id) }}" method="post" id="formHapusKategori-{{ $kategori->id }}">
                                @csrf
                                <button class="w-fit px-2 py-1 text-sm border border-l-0 border-pink bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active outline-none rounded-e-full transition-colors"
                                    type="button" onclick="hapusKategori({{ $kategori->id }})">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="w-fit px-2 py-1 text-sm border border-pink rounded-full">
                            no data
                        </div>
                    @endforelse
                </div>

                <div class="w-full p-4 pb-0">
                    @forelse ($woCategories as $woCtgDetail)
                        <div class="w-full hidden keterangan" id="keterangan-{{ $woCtgDetail->id }}">
                            {!! $woCtgDetail->w_categories->keterangan !!}
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>

        <div class="w-full h-fit flex-1">
            <div class="w-full flex-1 rounded shadow">
                <form action="{{ route('wedding-organizer.profil.tambah_kategori') }}" method="post">
                    @csrf
                    <div class="w-full px-2 py-1 bg-pink text-white font-semibold rounded-t">
                        Tambah Kategori
                    </div>

                    <div class="w-full">
                        <div class="w-full p-4">
                            @if ($categories->count() > 0)
                                <select class="w-full rounded px-2 py-4 text-sm border border-pink @error('kategori') border-red-500 @enderror outline-none"
                                    name="kategori" id="kategori">
                                    @foreach ($categories as $ctgOpsi)
                                        <option value="{{ $ctgOpsi->id }}">{{ $ctgOpsi->nama }}</option>
                                    @endforeach
                                </select>
                            @else
                                <select class="w-full rounded px-2 py-4 text-sm border border-slate-300 outline-none" disabled>
                                    <option value="">tidak ada data</option>
                                </select>
                            @endif
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('kategori')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if ($categories)
                        <div class="w-full p-4 pt-0">
                            @foreach ($categories as $ctgDetail)
                                <div class="select-kategori-detail hidden"
                                    id="select-kategori-{{ $ctgDetail->id }}">
                                    {!! $ctgDetail->keterangan !!}
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- BUTTON --}}
                    <div class="w-100 flex items-center justify-end gap-4 p-4">
                        <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                            href="{{ route('wedding-organizer.profil.index') }}">
                            <i class="fa-solid fa-arrow-left-long"></i>
                            <span>Kembali</span>
                        </a>

                        @if ($categories->count() > 0)
                            <button class="w-fit px-4 py-2 text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors rounded"
                                type="submit">
                                <i class="fa-regular fa-floppy-disk"></i>
                                <span>Simpan</span>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showDetail(id) {
            $('.select-kategori-detail').hide();
            $('#select-kategori-' + id).show();
        }

        function showKeterangan(id) {
            $('.keterangan').hide();
            $('#keterangan-' + id).show();
        }

        function hapusKategori(id) {
            if (confirm('Yakin ingin menghapus kategori ini?')) {
                let formID = 'formHapusKategori-' + id;
                const formHapus = document.getElementById(formID);
                formHapus.submit();
            }
        }

        $(document).ready(function() {
            const select = $('#kategori');

            select.change(function() {
                showDetail($(this).val());
            });

            showDetail(select.val());
        });
    </script>
@endsection
