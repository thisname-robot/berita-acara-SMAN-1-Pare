@extends('layouts.admin')

@section('title', 'Tulis Berita Baru — Portal Redaksi')
@section('breadcrumb', 'Tulis Berita')

@section('content')
    <div class="pb-6 border-b border-[#E2E8F0]">
        <h1 class="font-display text-2xl font-bold text-[#0F172A]">Tulis Berita / Artikel Baru</h1>
        <p class="text-xs text-[#64748B] mt-1">Lengkapi form naskah di bawah ini sebelum diajukan ke kurasi editor.</p>
    </div>

    @if($errors->any())
        <div role="alert" class="mt-6 rounded-lg bg-[#FEF2F2] border border-[#FECACA] px-4 py-3 text-sm text-[#93000A]">
            <p class="font-semibold">Mohon periksa kembali isian formulir:</p>
            <ul class="mt-1 list-disc list-inside space-y-0.5 text-xs">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Kolom Utama Konten (8 Kolom) --}}
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-sm space-y-4">
                    <div>
                        <label for="title" class="block text-xs font-semibold text-[#0F172A] mb-1.5">Judul Berita <span class="text-[#BA1A1A]">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Contoh: SMAN 1 Pare Raih Juara Umum LKS 2026" class="w-full rounded-lg border border-[#CBD5E1] px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A] focus:ring-1 focus:ring-[#0F172A]">
                    </div>

                    <div>
                        <label for="content" class="block text-xs font-semibold text-[#0F172A] mb-1.5">Isi Berita / Naskah <span class="text-[#BA1A1A]">*</span></label>
                        <textarea id="content" name="content" rows="12" required placeholder="Tulis atau tempel naskah berita lengkap di sini..." class="w-full rounded-lg border border-[#CBD5E1] px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A] focus:ring-1 focus:ring-[#0F172A]">{{ old('content') }}</textarea>
                        <p class="mt-1 text-[11px] text-[#64748B]">Dapat diintegrasikan dengan TinyMCE atau CKEditor.</p>
                    </div>
                </div>
            </div>

            {{-- Kolom Samping Pengaturan & Publikasi (4 Kolom) --}}
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-sm space-y-4">
                    <h2 class="font-display text-sm font-semibold text-[#0F172A] pb-2 border-b border-[#F1F5F9]">Pengaturan Publikasi</h2>

                    <div>
                        <label for="status" class="block text-xs font-semibold text-[#0F172A] mb-1.5">Status Naskah <span class="text-[#BA1A1A]">*</span></label>
                        <select id="status" name="status" class="w-full rounded-lg border border-[#CBD5E1] px-3 py-2 text-sm text-[#0F172A] focus:border-[#0F172A]">
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                            <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Kirim untuk Review (Pending)</option>
                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editor')
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Langsung Terbit (Published)</option>
                            @endif
                        </select>
                    </div>

                    <div>
                        <label for="category_id" class="block text-xs font-semibold text-[#0F172A] mb-1.5">Kategori Rubrik <span class="text-[#BA1A1A]">*</span></label>
                        <select id="category_id" name="category_id" required class="w-full rounded-lg border border-[#CBD5E1] px-3 py-2 text-sm text-[#0F172A] focus:border-[#0F172A]">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="thumbnail" class="block text-xs font-semibold text-[#0F172A] mb-1.5">Gambar Utama (Thumbnail 16:9)</label>
                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="w-full text-xs text-[#64748B] file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#0F172A] file:text-white hover:file:bg-[#1E293B]">
                    </div>

                    <div class="space-y-2 pt-2 border-t border-[#F1F5F9]">
                        <label class="flex items-center gap-2.5 text-xs font-medium text-[#0F172A]">
                            <input type="checkbox" name="is_headline" value="1" {{ old('is_headline') ? 'checked' : '' }} class="rounded border-[#CBD5E1] text-[#0F172A] focus:ring-[#0F172A]">
                            <span>Sematkan sebagai Berita Utama (Headline)</span>
                        </label>
                        <label class="flex items-center gap-2.5 text-xs font-medium text-[#0F172A]">
                            <input type="checkbox" name="is_breaking" value="1" {{ old('is_breaking') ? 'checked' : '' }} class="rounded border-[#CBD5E1] text-[#0F172A] focus:ring-[#0F172A]">
                            <span>Tampilkan di Ticker Breaking News</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[#0F172A] mb-1.5">Pilih Tagar (Tags)</label>
                        <div class="max-h-36 overflow-y-auto space-y-1.5 p-2 rounded-lg border border-[#E2E8F0] bg-[#F8FAFC]">
                            @foreach($tags as $tag)
                                <label class="flex items-center gap-2 text-xs text-[#475569]">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} class="rounded border-[#CBD5E1] text-[#0F172A]">
                                    <span>#{{ $tag->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="min-h-[44px] w-full px-4 py-2.5 rounded-lg bg-[#0F172A] text-white text-sm font-semibold hover:bg-[#1E293B] transition-colors">
                        Simpan Artikel
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
