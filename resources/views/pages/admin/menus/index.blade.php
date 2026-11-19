@extends('layouts.admin')

@section('title', 'Manajemen Menu Navigasi — Portal Redaksi')
@section('breadcrumb', 'Menu Portal')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-8 border-b border-[#E2E8F0]">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.04em] text-[#64748B] mb-1.5">
                Struktur Navigasi Halaman Utama
            </p>
            <h1 class="font-display text-[26px] sm:text-[32px] font-bold text-[#0F172A] leading-[1.2] tracking-[-0.025em]">
                Manajemen Menu Navigasi
            </h1>
        </div>
    </div>

    @if ($errors->any())
        <div role="alert" class="mt-6 rounded-lg bg-[#FEF2F2] border border-[#FECACA] px-4 py-3 text-sm text-[#93000A]">
            <p class="font-semibold">Mohon periksa kembali isian formulir:</p>
            <ul class="mt-1 list-disc list-inside text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        {{-- Kolom Kiri: Form Tambah Menu (4 Kolom) --}}
        <section aria-labelledby="form-menu-heading"
            class="lg:col-span-4 bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-sm">
            <h2 id="form-menu-heading" class="font-display text-base font-semibold text-[#0F172A]">
                Tambah Menu Baru
            </h2>
            <p class="mt-0.5 text-xs text-[#64748B]">
                Tambahkan tautan internal maupun sistem eksternal sekolah seperti SIMS atau PPDB.
            </p>

            <form action="{{ route('admin.menus.store') }}" method="POST" class="mt-5 space-y-4">
                @csrf

                <div>
                    <label for="label" class="block text-xs font-semibold text-[#0F172A] mb-1.5">
                        Label Menu <span class="text-[#BA1A1A]">*</span>
                    </label>
                    <input type="text" id="label" name="label" value="{{ old('label') }}" required
                        placeholder="Contoh: SIMS SMANSA"
                        class="w-full rounded-lg border border-[#CBD5E1] px-3.5 py-2.5 text-sm text-[#0F172A] placeholder-[#94A3B8] focus:border-[#0F172A]">
                </div>

                <div>
                    <label for="url" class="block text-xs font-semibold text-[#0F172A] mb-1.5">
                        URL Tujuan <span class="text-[#BA1A1A]">*</span>
                    </label>
                    <input type="text" id="url" name="url" value="{{ old('url') }}" required
                        placeholder="https://sims.sman1pare.sch.id"
                        class="w-full rounded-lg border border-[#CBD5E1] px-3.5 py-2.5 text-sm text-[#0F172A] placeholder-[#94A3B8] focus:border-[#0F172A]">
                    <p class="mt-1 text-[11px] text-[#64748B]">Gunakan awalan https:// untuk website eksternal, atau /path
                        untuk halaman internal.</p>
                </div>

                <div>
                    <label for="order" class="block text-xs font-semibold text-[#0F172A] mb-1.5">
                        Urutan Tampil
                    </label>
                    <input type="number" id="order" name="order" value="{{ old('order', 1) }}" min="0"
                        class="w-full rounded-lg border border-[#CBD5E1] px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A]">
                </div>

                {{-- <div class="pt-1">
                    <label class="flex items-center gap-2.5 text-xs font-medium text-[#0F172A]">
                        <input type="checkbox" name="open_in_new_tab" value="1"
                            {{ old('open_in_new_tab', true) ? 'checked' : '' }}
                            class="rounded border-[#CBD5E1] text-[#0F172A] focus:ring-[#0F172A]">
                        <span>Buka di tab baru (direkomendasikan untuk SIMS)</span>
                    </label>
                </div> --}}

                <button type="submit"
                    class="min-h-[44px] w-full px-4 py-2.5 rounded-lg bg-[#0F172A] text-white text-sm font-semibold hover:bg-[#1E293B] transition-colors">
                    Simpan Menu
                </button>
            </form>
        </section>

        {{-- Kolom Kanan: Tabel Daftar Menu (8 Kolom) --}}
        <section aria-labelledby="tabel-menu-heading"
            class="lg:col-span-8 bg-white rounded-lg border border-[#E2E8F0] shadow-sm overflow-hidden">
            <div class="p-6 border-b border-[#F1F5F9]">
                <h2 id="tabel-menu-heading" class="font-display text-base font-semibold text-[#0F172A]">
                    Daftar Menu Navigasi Portal
                </h2>
                <p class="mt-0.5 text-xs text-[#64748B]">
                    Menu dengan status aktif akan otomatis tampil di bilah navigasi halaman berita utama.
                </p>
            </div>

            @if ($menus->isEmpty())
                <div class="p-10 text-center">
                    <p class="text-sm font-medium text-[#64748B]">Belum ada menu kustom yang ditambahkan.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-[#F8FAFC] border-b border-[#E2E8F0] text-[11px] font-semibold uppercase tracking-[0.04em] text-[#64748B]">
                                <th scope="col" class="py-3.5 px-6">Urutan</th>
                                <th scope="col" class="py-3.5 px-4">Label &amp; URL</th>
                                <th scope="col" class="py-3.5 px-4 text-center">Status</th>
                                <th scope="col" class="py-3.5 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#F1F5F9] text-sm">
                            @foreach ($menus as $menu)
                                <tr class="hover:bg-[#F8FAFC] transition-colors">
                                    <td class="py-4 px-6 font-mono text-xs font-semibold text-[#0F172A]">
                                        #{{ $menu->order }}
                                    </td>
                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-[#0F172A] flex items-center gap-1.5">
                                            <span>{{ $menu->label }}</span>
                                            @if ($menu->open_in_new_tab)
                                                <span
                                                    class="text-[10px] px-1.5 py-0.5 rounded bg-[#F1F5F9] text-[#475569] border border-[#E2E8F0]">Tab
                                                    Baru</span>
                                            @endif
                                        </p>
                                        <p class="text-xs text-[#64748B] truncate max-w-xs">{{ $menu->url }}</p>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        @if ($menu->is_active)
                                            <span
                                                class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold bg-[#ECFDF5] text-[#047857] border border-[#A7F3D0]">
                                                Aktif
                                            </span>
                                        @else
                                            <span
                                                class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold bg-[#F1F5F9] text-[#475569] border border-[#E2E8F0]">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <form action="{{ route('admin.menus.toggle', $menu) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="min-h-[36px] px-3 py-1.5 rounded-md border border-[#CBD5E1] bg-white text-xs font-semibold text-[#0F172A] hover:bg-[#F1F5F9] transition-colors">
                                                    {{ $menu->is_active ? 'Sembunyikan' : 'Tampilkan' }}
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST"
                                                onsubmit="return confirm('Hapus menu {{ $menu->label }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="min-h-[36px] px-3 py-1.5 rounded-md text-xs font-semibold text-[#BA1A1A] hover:bg-[#FEF2F2] transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
@endsection
