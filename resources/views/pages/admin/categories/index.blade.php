@extends('layouts.admin')

@section('title', 'Manajemen Kategori & Tag — Portal Redaksi')
@section('breadcrumb', 'Kategori & Tag')

@section('content')
    {{-- Header Halaman --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-8 border-b border-[#E2E8F0]">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.04em] text-[#64748B] mb-1.5">
                Pengelolaan Taksonomi Berita
            </p>
            <h1 class="font-display text-[26px] sm:text-[32px] font-bold text-[#0F172A] leading-[1.2] tracking-[-0.025em]">
                Kategori & Tagar (Tags)
            </h1>
        </div>
    </div>

    {{-- Pesan Validasi / Error Global --}}
    @if ($errors->any())
        <div role="alert" class="mt-6 rounded-lg bg-[#FEF2F2] border border-[#FECACA] px-4 py-3 text-sm text-[#93000A]">
            <p class="font-semibold">Mohon periksa kembali form masukan Anda:</p>
            <ul class="mt-1 list-disc list-inside space-y-0.5 text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Grid Utama: Kategori (Form + Tabel) --}}
    <div class="mt-8 mb-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        {{-- Kolom Kiri (4 Kolom): Form Tambah Kategori Baru --}}
        <section aria-labelledby="form-kategori-heading"
            class="lg:col-span-4 bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)]">
            <h2 id="form-kategori-heading" class="font-display text-base font-semibold text-[#0F172A] tracking-[-0.005em]">
                Tambah Kategori Baru
            </h2>
            <p class="mt-0.5 text-xs text-[#64748B]">
                Kategori digunakan untuk mengelompokkan rubrik berita utama sekolah.
            </p>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="mt-5 space-y-4">
                @csrf

                <div>
                    <label for="category_name" class="block text-xs font-semibold text-[#0F172A] mb-1.5">
                        Nama Kategori <span class="text-[#BA1A1A]" aria-hidden="true">*</span>
                    </label>
                    <input type="text" id="category_name" name="name" value="{{ old('name') }}" required
                        placeholder="Contoh: Prestasi Siswa"
                        class="w-full rounded-lg border border-[#CBD5E1] bg-white px-3.5 py-2.5 text-sm text-[#0F172A] placeholder-[#94A3B8] focus:border-[#0F172A] focus:ring-1 focus:ring-[#0F172A]">
                </div>

                <div>
                    <label for="category_color" class="block text-xs font-semibold text-[#0F172A] mb-1.5">
                        Kode Warna Label (Hex) <span class="text-[#BA1A1A]" aria-hidden="true">*</span>
                    </label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="category_color" name="color_code"
                            value="{{ old('color_code', '#0055A5') }}"
                            class="w-11 h-11 rounded-lg border border-[#CBD5E1] bg-white p-1 cursor-pointer">
                        <input type="text" name="color_code_text" value="{{ old('color_code', '#0055A5') }}"
                            maxlength="7" placeholder="#0055A5" x-data
                            @input="$el.previousElementSibling.value = $el.value"
                            class="flex-1 rounded-lg border border-[#CBD5E1] bg-white px-3.5 py-2.5 text-sm font-mono text-[#0F172A] placeholder-[#94A3B8] focus:border-[#0F172A] focus:ring-1 focus:ring-[#0F172A]">
                    </div>
                    <p class="mt-1 text-[11px] text-[#64748B]">Digunakan sebagai titik penanda visual rubrik.</p>
                </div>

                <button type="submit"
                    class="min-h-[44px] w-full px-4 py-2.5 rounded-lg bg-[#0F172A] text-white text-sm font-semibold hover:bg-[#1E293B] flex items-center justify-center gap-2 transition-colors">
                    <span>Simpan Kategori</span>
                </button>
            </form>
        </section>

        {{-- Kolom Kanan (8 Kolom): Tabel Daftar Kategori --}}
        <section aria-labelledby="tabel-kategori-heading"
            class="lg:col-span-8 bg-white rounded-lg border border-[#E2E8F0] shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)] overflow-hidden">
            <div class="p-6 border-b border-[#F1F5F9]">
                <h2 id="tabel-kategori-heading"
                    class="font-display text-base font-semibold text-[#0F172A] tracking-[-0.005em]">
                    Daftar Kategori Aktif
                </h2>
                <p class="mt-0.5 text-xs text-[#64748B]">
                    Total {{ $categories->count() }} kategori terdaftar dalam sistem portal.
                </p>
            </div>

            @if ($categories->isEmpty())
                <div class="p-10 text-center">
                    <p class="text-sm font-medium text-[#64748B]">Belum ada kategori yang ditambahkan.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-[#F8FAFC] border-b border-[#E2E8F0] text-[11px] font-semibold uppercase tracking-[0.04em] text-[#64748B]">
                                <th scope="col" class="py-3.5 px-6">Kategori</th>
                                <th scope="col" class="py-3.5 px-4">Slug URL</th>
                                <th scope="col" class="py-3.5 px-4 text-center">Jumlah Artikel</th>
                                <th scope="col" class="py-3.5 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#F1F5F9] text-sm">
                            @foreach ($categories as $category)
                                <tr class="hover:bg-[#F8FAFC] transition-colors">
                                    <td class="py-4 px-6 font-medium text-[#0F172A]">
                                        <div class="flex items-center gap-3">
                                            <span class="w-3.5 h-3.5 rounded-full shrink-0 border border-black/10"
                                                style="background-color: {{ $category->color_code }}"
                                                aria-hidden="true"></span>
                                            <span>{{ $category->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 font-mono text-xs text-[#64748B]">
                                        {{ $category->slug }}
                                    </td>
                                    <td class="py-4 px-4 text-center tabular-nums text-[#0F172A] font-medium">
                                        {{ $category->articles_count ?? 0 }}
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $category->name }}?')"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 min-h-[36px] px-3 py-1.5 rounded-md text-xs font-semibold text-[#BA1A1A] hover:bg-[#FEF2F2] transition-colors">
                                                <!-- SVG Ikon Hapus -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

    </div>

    {{-- Bagian Kedua: Manajemen Tagar (Tags) --}}
    <div class="mt-12 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start pb-12">

        {{-- Form Tambah Tagar (4 Kolom) --}}
        <section aria-labelledby="form-tag-heading"
            class="lg:col-span-4 bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)]">
            <h2 id="form-tag-heading" class="font-display text-base font-semibold text-[#0F172A] tracking-[-0.005em]">
                Tambah Tagar (Tag)
            </h2>
            <p class="mt-0.5 text-xs text-[#64748B]">
                Tagar topik spesifik seperti #LKS2026 atau #Pramuka.
            </p>

            <form action="{{ route('admin.tags.store') }}" method="POST" class="mt-5 space-y-4">
                @csrf

                <div>
                    <label for="tag_name" class="block text-xs font-semibold text-[#0F172A] mb-1.5">
                        Nama Tagar <span class="text-[#BA1A1A]" aria-hidden="true">*</span>
                    </label>
                    <input type="text" id="tag_name" name="name" value="{{ old('name') }}" required
                        placeholder="Contoh: LKS2026"
                        class="w-full rounded-lg border border-[#CBD5E1] bg-white px-3.5 py-2.5 text-sm text-[#0F172A] placeholder-[#94A3B8] focus:border-[#0F172A] focus:ring-1 focus:ring-[#0F172A] mb-2">
                </div>

                <button type="submit"
                    class="min-h-[44px] w-full px-4 py-2.5 rounded-lg bg-[#0F172A] text-white text-sm font-semibold hover:bg-[#1E293B] flex items-center justify-center gap-2 transition-colors">
                    <span>Simpan Tagar</span>
                </button>
            </form>
        </section>

        {{-- Daftar Tagar / Badges (8 Kolom) --}}
        <section aria-labelledby="list-tag-heading"
            class="lg:col-span-8 bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)]">
            <div class="pb-4 border-b border-[#F1F5F9]">
                <h2 id="list-tag-heading" class="font-display text-base font-semibold text-[#0F172A] tracking-[-0.005em]">
                    Daftar Tagar Aktif
                </h2>
                <p class="mt-0.5 text-xs text-[#64748B]">
                    Total {{ $tags->count() }} tagar topik terdaftar.
                </p>
            </div>

            @if ($tags->isEmpty())
                <div class="py-8 text-center">
                    <p class="text-xs font-medium text-[#64748B]">Belum ada tagar yang ditambahkan.</p>
                </div>
            @else
                <div class="mt-5 flex flex-wrap gap-2">
                    @foreach ($tags as $tag)
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#F1F5F9] border border-[#E2E8F0] text-xs font-medium text-[#0F172A] mt-2">
                            <span>#{{ $tag->name }}</span>
                            <span class="text-[10px] text-[#64748B] tabular-nums">({{ $tag->articles_count ?? 0 }})</span>
                            <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST"
                                onsubmit="return confirm('Hapus tagar #{{ $tag->name }}?')"
                                class="inline-flex items-center">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-4 h-4 rounded-full text-[#64748B] hover:text-[#BA1A1A] hover:bg-[#FEF2F2] flex items-center justify-center transition-colors"
                                    aria-label="Hapus tag {{ $tag->name }}">
                                    &times;
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

    </div>
@endsection
