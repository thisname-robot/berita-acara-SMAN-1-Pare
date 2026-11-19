@extends('layouts.admin')

@section('title', 'Konfigurasi & Pemeliharaan Sistem — Portal Redaksi')
@section('breadcrumb', 'Pengaturan Sistem')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-8 border-b border-[#E2E8F0]">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.04em] text-[#64748B] mb-1.5">
                Manajemen Infrastruktur IT Sekolah
            </p>
            <h1 class="font-display text-[26px] sm:text-[32px] font-bold text-[#0F172A] leading-[1.2] tracking-[-0.025em]">
                Pengaturan Portal & Pemeliharaan
            </h1>
        </div>
    </div>

    @if (session('status'))
        <div role="status"
            class="mt-6 rounded-lg bg-[#ECFDF5] border border-[#A7F3D0] px-4 py-3 text-sm text-[#047857] flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">check_circle</span>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div role="alert" class="mt-6 rounded-lg bg-[#FEF2F2] border border-[#FECACA] px-4 py-3 text-sm text-[#93000A]">
            <p class="font-semibold">Terjadi kesalahan:</p>
            <ul class="mt-1 list-disc list-inside text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        {{-- Kolom Kiri: Form Konfigurasi Umum (8 Kolom) --}}
        <section aria-labelledby="general-settings-heading"
            class="lg:col-span-8 bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-sm">
            <h2 id="general-settings-heading"
                class="font-display text-base font-semibold text-[#0F172A] tracking-[-0.005em]">
                Identitas &amp; Integrasi Portal Sekolah
            </h2>
            <p class="mt-0.5 text-xs text-[#64748B]">
                Atur informasi identitas portal serta tautan sistem eksternal SMAN 1 Pare.
            </p>

            <form action="{{ route('admin.settings.update') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="site_name" class="block text-xs font-semibold text-[#0F172A] mb-1.5">Nama Portal / Situs
                            <span class="text-[#BA1A1A]">*</span></label>
                        <input type="text" id="site_name" name="site_name"
                            value="{{ old('site_name', $settings['site_name']) }}" required
                            class="w-full rounded-lg border border-[#CBD5F1] px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A]">
                    </div>
                    <div>
                        <label for="school_tagline" class="block text-xs font-semibold text-[#0F172A] mb-1.5">Slogan /
                            Tagline Sekolah <span class="text-[#BA1A1A]">*</span></label>
                        <input type="text" id="school_tagline" name="school_tagline"
                            value="{{ old('school_tagline', $settings['school_tagline']) }}" required
                            class="w-full rounded-lg border border-[#CBD5F1] px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="contact_email" class="block text-xs font-semibold text-[#0F172A] mb-1.5">Email Humas
                            <span class="text-[#BA1A1A]">*</span></label>
                        <input type="email" id="contact_email" name="contact_email"
                            value="{{ old('contact_email', $settings['contact_email']) }}" required
                            class="w-full rounded-lg border border-[#CBD5F1] px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A]">
                    </div>
                    <div>
                        <label for="contact_phone" class="block text-xs font-semibold text-[#0F172A] mb-1.5">Nomor Telepon /
                            Ekstensi <span class="text-[#BA1A1A]">*</span></label>
                        <input type="text" id="contact_phone" name="contact_phone"
                            value="{{ old('contact_phone', $settings['contact_phone']) }}" required
                            class="w-full rounded-lg border border-[#CBD5F1] px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="ppdb_link" class="block text-xs font-semibold text-[#0F172A] mb-1.5">Tautan Sistem
                            PPDB</label>
                        <input type="url" id="ppdb_link" name="ppdb_link"
                            value="{{ old('ppdb_link', $settings['ppdb_link']) }}"
                            placeholder="https://ppdb.sman1pare.sch.id"
                            class="w-full rounded-lg border border-[#CBD5F1] px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A]">
                    </div>
                    <div>
                        <label for="elearning_link" class="block text-xs font-semibold text-[#0F172A] mb-1.5">Tautan Sistem
                            E-Learning</label>
                        <input type="url" id="elearning_link" name="elearning_link"
                            value="{{ old('elearning_link', $settings['elearning_link']) }}"
                            placeholder="https://elearning.sman1pare.sch.id"
                            class="w-full rounded-lg border border-[#CBD5F1] px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A]">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="min-h-[44px] px-5 py-2.5 rounded-lg bg-[#0F172A] text-white text-sm font-semibold hover:bg-[#1E293B] transition-colors">
                        Simpan Perubahan Pengaturan
                    </button>
                </div>
            </form>
        </section>

        {{-- Kolom Kanan: Pemeliharaan & Backup (4 Kolom) --}}
        <aside aria-labelledby="maintenance-heading" class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-sm space-y-4">
                <h2 id="maintenance-heading"
                    class="font-display text-base font-semibold text-[#0F172A] tracking-[-0.005em]">
                    Pemeliharaan &amp; Cadangan
                </h2>
                <p class="text-xs text-[#64748B]">
                    Fasilitas pencadangan database berkala guna mengantisipasi lonjakan trafik atau kendala teknis[cite: 9].
                </p>

                <div class="p-4 rounded-lg bg-[#F8FAFC] border border-[#E2E8F0] space-y-3">
                    <div>
                        <span class="block font-semibold text-xs text-[#0F172A]">Backup Basis Data (SQL)</span>
                        <span class="block text-[11px] text-[#64748B] mt-0.5">Unduh atau buat arsip cadangan tabel berita,
                            komentar, dan pengguna.</span>
                    </div>
                    <form action="{{ route('admin.settings.backup') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="min-h-[40px] w-full px-4 py-2 rounded-lg border border-[#CBD5E1] bg-white text-xs font-semibold text-[#0F172A] hover:bg-[#F1F5F9] transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[16px]">database</span>
                            <span>Jalankan Backup Sekarang</span>
                        </button>
                    </form>
                </div>

                <div class="p-4 rounded-lg bg-[#F8FAFC] border border-[#E2E8F0] space-y-2">
                    <span class="block font-semibold text-xs text-[#0F172A]">Informasi Server Portal</span>
                    <ul class="text-[11px] text-[#64748B] space-y-1">
                        <li>Framework: Laravel 13 (PHP {{ PHP_VERSION }})</li>
                        <li>Database Driver: MySQL / MariaDB</li>
                        <li>Status Cache: Aktif (File / Redis)</li>
                    </ul>
                </div>
            </div>
        </aside>
    </div>
@endsection
