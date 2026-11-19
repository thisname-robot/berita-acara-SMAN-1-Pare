@extends('layouts.admin')

@section('title', 'Dashboard Redaksi')
@section('breadcrumb', 'Dashboard')

@section('content')
    {{-- Header Halaman & Aksi Utama --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-8 border-b border-[#E2E8F0]">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.04em] text-[#64748B] mb-1.5">
                Ikhtisar Operasional Portal
            </p>
            <h1 class="font-display text-[26px] sm:text-[32px] font-bold text-[#0F172A] leading-[1.2] tracking-[-0.025em]">
                Dashboard Redaksi & Publikasi
            </h1>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            @if (Route::has('admin.articles.create'))
                <a href="{{ route('admin.articles.create') }}"
                    class="min-h-[44px] px-4 py-2.5 rounded-lg bg-[#0F172A] text-white text-sm font-semibold hover:bg-[#1E293B] inline-flex items-center gap-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Tulis Berita Baru</span>
                </a>
            @else
                <a href="#antrean-publikasi"
                    class="min-h-[44px] px-4 py-2.5 rounded-lg bg-[#0F172A] text-white text-sm font-semibold hover:bg-[#1E293B] inline-flex items-center gap-2 transition-colors">
                    <span>Tinjau Antrean Naskah</span>
                </a>
            @endif
        </div>
    </div>

    {{-- Section 1: Matriks Metrik Ringkasan (4 Kolom Desktop, 2 Tablet, 1 Mobile) --}}
    <section aria-labelledby="ringkasan-statistik-heading" class="mt-8">
        <h2 id="ringkasan-statistik-heading" class="sr-only">Ringkasan Statistik Portal</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            {{-- Metrik 1: Artikel Terbit --}}
            <article
                class="bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)]">
                <div class="flex items-center justify-between gap-2">
                    <span class="text-xs font-semibold uppercase tracking-[0.04em] text-[#64748B]">Artikel Terbit</span>
                    <span
                        class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-[#ECFDF5] text-[#047857] border border-[#A7F3D0]">
                        Publik
                    </span>
                </div>
                <p class="mt-4 font-display text-3xl font-bold text-[#0F172A] tracking-[-0.02em] tabular-nums">
                    {{ number_format($totalPublishedArticles ?? 0, 0, ',', '.') }}
                </p>
                <p class="mt-1.5 text-xs text-[#64748B]">
                    Total berita aktif di portal sekolah
                </p>
            </article>

            {{-- Metrik 2: Menunggu Kurasi (Aksen Amber / Tertiary untuk Perhatian Editor) --}}
            <article
                class="bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)]">
                <div class="flex items-center justify-between gap-2">
                    <span class="text-xs font-semibold uppercase tracking-[0.04em] text-[#64748B]">Perlu Kurasi</span>
                    @if (($pendingArticlesCount ?? 0) > 0)
                        <span
                            class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-[#FEF3C7] text-[#B45309] border border-[#FDE68A]">
                            Antrean
                        </span>
                    @else
                        <span
                            class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-[#F1F5F9] text-[#475569] border border-[#E2E8F0]">
                            Terkendali
                        </span>
                    @endif
                </div>
                <p class="mt-4 font-display text-3xl font-bold text-[#0F172A] tracking-[-0.02em] tabular-nums">
                    {{ number_format($pendingArticlesCount ?? 0, 0, ',', '.') }}
                </p>
                <p class="mt-1.5 text-xs text-[#64748B]">
                    Draft, review editor, dan revisi
                </p>
            </article>

            {{-- Metrik 3: Total Pembacaan --}}
            <article
                class="bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)]">
                <div class="flex items-center justify-between gap-2">
                    <span class="text-xs font-semibold uppercase tracking-[0.04em] text-[#64748B]">Total Pembacaan</span>
                    <span
                        class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-[#F1F5F9] text-[#475569] border border-[#E2E8F0]">
                        Kumulatif
                    </span>
                </div>
                <p class="mt-4 font-display text-3xl font-bold text-[#0F172A] tracking-[-0.02em] tabular-nums">
                    {{ number_format($totalViews ?? 0, 0, ',', '.') }}
                </p>
                <p class="mt-1.5 text-xs text-[#64748B]">
                    Akumulasi tayangan seluruh artikel
                </p>
            </article>

            {{-- Metrik 4: Civitas & Staf Redaksi --}}
            <article
                class="bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)]">
                <div class="flex items-center justify-between gap-2">
                    <span class="text-xs font-semibold uppercase tracking-[0.04em] text-[#64748B]">Siswa & Redaksi</span>
                    <span
                        class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-[#F1F5F9] text-[#475569] border border-[#E2E8F0]">
                        Aktif
                    </span>
                </div>
                <div class="mt-4 flex items-baseline gap-3">
                    <p class="font-display text-3xl font-bold text-[#0F172A] tracking-[-0.02em] tabular-nums">
                        {{ number_format($totalStudents ?? 0, 0, ',', '.') }}
                    </p>
                    <span class="text-xs font-medium text-[#64748B]">
                        siswa &middot; {{ number_format($totalStaff ?? 0, 0, ',', '.') }} staf
                    </span>
                </div>
                <p class="mt-1.5 text-xs text-[#64748B]">
                    Basis pembaca internal & tim penulis
                </p>
            </article>
        </div>
    </section>

    {{-- Section 2: Ritme Asimetris 12 Kolom (8 Kolom Antrean Kurasi + 4 Kolom Artikel Populer) --}}
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        {{-- Kolom Kiri (8 Kolom): Focal Point Utama - Antrean Publikasi & Kurasi Naskah --}}
        <section id="antrean-publikasi" aria-labelledby="editorial-queue-heading" x-data="{ activeFilter: 'all' }"
            class="lg:col-span-8 bg-white rounded-lg border border-[#E2E8F0] shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)] overflow-hidden">

            <div class="p-6 border-b border-[#F1F5F9] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 id="editorial-queue-heading"
                        class="font-display text-lg font-semibold text-[#0F172A] tracking-[-0.01em]">
                        Antrean Publikasi & Aktivitas Naskah
                    </h2>
                    <p class="mt-0.5 text-xs text-[#64748B]">
                        Daftar 5 naskah terbaru beserta status penyuntingan terkini.
                    </p>
                </div>

                {{-- Navigation Pill Tabs sesuai DESIGN.md --}}
                <div role="tablist" aria-label="Filter status naskah"
                    class="inline-flex items-center p-1 rounded-full bg-[#F1F5F9] self-start sm:self-auto">
                    <button type="button" role="tab" :aria-selected="activeFilter === 'all'"
                        @click="activeFilter = 'all'"
                        :class="activeFilter === 'all' ? 'bg-white text-[#0F172A] shadow-[0_1px_2px_rgba(15,23,42,0.06)]' :
                            'text-[#64748B] hover:text-[#475569]'"
                        class="min-h-[36px] px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all">
                        Semua
                    </button>
                    <button type="button" role="tab" :aria-selected="activeFilter === 'review'"
                        @click="activeFilter = 'review'"
                        :class="activeFilter === 'review' ? 'bg-white text-[#0F172A] shadow-[0_1px_2px_rgba(15,23,42,0.06)]' :
                            'text-[#64748B] hover:text-[#475569]'"
                        class="min-h-[36px] px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all">
                        Menunggu / Revisi
                    </button>
                    <button type="button" role="tab" :aria-selected="activeFilter === 'published'"
                        @click="activeFilter = 'published'"
                        :class="activeFilter === 'published' ?
                            'bg-white text-[#0F172A] shadow-[0_1px_2px_rgba(15,23,42,0.06)]' :
                            'text-[#64748B] hover:text-[#475569]'"
                        class="min-h-[36px] px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all">
                        Terbit
                    </button>
                </div>
            </div>

            @if (!isset($pendingArticles))
                {{-- Error / Missing Data State (R-27) --}}
                <div class="p-8 text-center">
                    <p class="text-sm font-semibold text-[#BA1A1A]">Data antrean artikel tidak tersedia.</p>
                    <p class="mt-1 text-xs text-[#64748B]">Pastikan controller mengirimkan variabel <code
                            class="px-1.5 py-0.5 rounded bg-[#F1F5F9] text-[#0F172A]">$pendingArticles</code> ke tampilan
                        ini.</p>
                </div>
            @elseif($pendingArticles->isEmpty())
                {{-- Empty State (R-27) --}}
                <div class="p-10 text-center">
                    <div class="w-10 h-10 mx-auto rounded-full bg-[#F1F5F9] border border-[#E2E8F0] flex items-center justify-center text-[#64748B]"
                        aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h3 class="mt-3 font-display text-sm font-semibold text-[#0F172A]">Belum ada naskah dalam antrean</h3>
                    <p class="mt-1 text-xs text-[#64748B] max-w-sm mx-auto">
                        Semua naskah berita sekolah telah diproses atau belum ada artikel yang dibuat oleh penulis.
                    </p>
                </div>
            @else
                {{-- Daftar Artikel Responsif (Tabel di Desktop, Kartu Terstruktur di Mobile agar R-03 tanpa overflow) --}}
                <div class="divide-y divide-[#F1F5F9]">
                    @foreach ($pendingArticles as $article)
                        @php
                            $statusMap = [
                                'published' => [
                                    'label' => 'Terbit',
                                    'group' => 'published',
                                    'classes' => 'bg-[#ECFDF5] text-[#047857] border-[#A7F3D0]',
                                ],
                                'pending' => [
                                    'label' => 'Menunggu Review',
                                    'group' => 'review',
                                    'classes' => 'bg-[#FEF3C7] text-[#B45309] border-[#FDE68A]',
                                ],
                                'revision_needed' => [
                                    'label' => 'Perlu Revisi',
                                    'group' => 'review',
                                    'classes' => 'bg-[#FFEDED] text-[#93000A] border-[#FECACA]',
                                ],
                                'draft' => [
                                    'label' => 'Draft',
                                    'group' => 'review',
                                    'classes' => 'bg-[#F1F5F9] text-[#475569] border-[#E2E8F0]',
                                ],
                            ];
                            $currentStatus = $statusMap[$article->status] ?? $statusMap['draft'];
                        @endphp

                        <article x-show="activeFilter === 'all' || activeFilter === '{{ $currentStatus['group'] }}'"
                            class="p-5 sm:px-6 hover:bg-[#F8FAFC] transition-colors flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="min-w-0 space-y-1.5">
                                <div class="flex flex-wrap items-center gap-2">
                                    {{-- Badge Kategori dengan aksen warna dari database --}}
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-[#F1F5F9] text-[#475569] border border-[#E2E8F0]">
                                        <span class="w-1.5 h-1.5 rounded-full shrink-0"
                                            style="background-color: {{ $article->category->color_code ?? '#0F172A' }}"
                                            aria-hidden="true"></span>
                                        {{ $article->category->name ?? 'Umum' }}
                                    </span>

                                    @if ($article->is_headline)
                                        <span
                                            class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-[#0F172A] text-white">
                                            Headline
                                        </span>
                                    @endif

                                    @if ($article->is_breaking)
                                        <span
                                            class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-[#FEF3C7] text-[#B45309] border border-[#FDE68A]">
                                            Breaking
                                        </span>
                                    @endif
                                </div>

                                <h3 class="font-display text-[15px] font-semibold text-[#0F172A] leading-snug">
                                    @if (Route::has('admin.articles.edit'))
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="hover:underline">
                                            {{ $article->title }}
                                        </a>
                                    @else
                                        {{ $article->title }}
                                    @endif
                                </h3>

                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-[#64748B]">
                                    <span>Oleh <strong
                                            class="font-medium text-[#0F172A]">{{ $article->user->name ?? 'Penulis' }}</strong></span>
                                    <span aria-hidden="true">&middot;</span>
                                    <time datetime="{{ $article->created_at?->toIso8601String() }}">
                                        {{ $article->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}
                                    </time>
                                </div>

                                @if ($article->status === 'revision_needed' && !empty($article->revision_note))
                                    <p
                                        class="mt-1.5 text-xs text-[#93000A] bg-[#FEF2F2] border border-[#FECACA] rounded-md px-3 py-1.5">
                                        <strong>Catatan Editor:</strong> {{ Str::limit($article->revision_note, 110) }}
                                    </p>
                                @endif
                            </div>

                            <div
                                class="flex items-center justify-between sm:justify-end gap-3 shrink-0 pt-2 sm:pt-0 border-t sm:border-t-0 border-[#F1F5F9]">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold border {{ $currentStatus['classes'] }}">
                                    {{ $currentStatus['label'] }}
                                </span>

                                @if (Route::has('admin.articles.edit'))
                                    <a href="{{ route('admin.articles.edit', $article) }}"
                                        class="min-h-[44px] min-w-[44px] px-3 py-2 rounded-lg border border-[#CBD5E1] bg-white text-xs font-semibold text-[#0F172A] hover:bg-[#F1F5F9] inline-flex items-center justify-center transition-colors"
                                        aria-label="Sunting artikel {{ $article->title }}">
                                        Sunting
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>

                @if (Route::has('admin.articles.index'))
                    <div class="px-6 py-3.5 bg-[#F8FAFC] border-t border-[#E2E8F0] flex justify-end">
                        <a href="{{ route('admin.articles.index') }}"
                            class="min-h-[44px] px-3 py-2 rounded-lg text-xs font-semibold text-[#0F172A] hover:bg-[#E2E8F0]/60 inline-flex items-center gap-1.5 transition-colors">
                            <span>Lihat Seluruh Manajemen Berita</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    </div>
                @endif
            @endif
        </section>

        {{-- Kolom Kanan (4 Kolom): Artikel Terpopuler & Komposisi Status --}}
        <aside aria-labelledby="popular-articles-heading" class="lg:col-span-4 space-y-6">
            <section
                class="bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)]">
                <div class="pb-4 border-b border-[#F1F5F9]">
                    <h2 id="popular-articles-heading"
                        class="font-display text-base font-semibold text-[#0F172A] tracking-[-0.005em]">
                        Berita Paling Banyak Dibaca
                    </h2>
                    <p class="mt-0.5 text-xs text-[#64748B]">
                        3 publikasi dengan jumlah tayangan tertinggi.
                    </p>
                </div>

                @if (!isset($popularArticles) || $popularArticles->isEmpty())
                    <div class="py-8 text-center">
                        <p class="text-xs font-medium text-[#64748B]">Belum ada data tayangan artikel terbit.</p>
                    </div>
                @else
                    <ol class="mt-4 divide-y divide-[#F1F5F9]">
                        @foreach ($popularArticles as $index => $popular)
                            <li class="py-3.5 first:pt-0 last:pb-0 flex items-start gap-3.5">
                                <span
                                    class="w-7 h-7 rounded-lg bg-[#F1F5F9] border border-[#E2E8F0] text-xs font-display font-bold text-[#0F172A] flex items-center justify-center shrink-0 mt-0.5">
                                    0{{ $index + 1 }}
                                </span>
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-sm font-semibold text-[#0F172A] leading-snug line-clamp-2">
                                        @if (Route::has('admin.articles.edit'))
                                            <a href="{{ route('admin.articles.edit', $popular) }}"
                                                class="hover:underline">
                                                {{ $popular->title }}
                                            </a>
                                        @else
                                            {{ $popular->title }}
                                        @endif
                                    </h3>
                                    <div class="mt-1.5 flex items-center justify-between gap-2 text-xs text-[#64748B]">
                                        <span>{{ $popular->published_at?->translatedFormat('d M Y') ?? 'Terbit' }}</span>
                                        <span class="font-semibold text-[#0F172A] tabular-nums">
                                            {{ number_format($popular->views_count ?? 0, 0, ',', '.') }} tayangan
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </section>

            {{-- Kartu Panduan Alur Redaksi (Sesuai Enum Status di Migrasi) --}}
            <section aria-labelledby="workflow-guide-heading"
                class="bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)]">
                <h2 id="workflow-guide-heading"
                    class="font-display text-base font-semibold text-[#0F172A] tracking-[-0.005em]">
                    Alur Kurasi Redaksi
                </h2>
                <p class="mt-1 text-xs text-[#64748B] leading-relaxed">
                    Setiap naskah dari <strong class="text-[#0F172A] font-medium">Writer</strong> melewati tahap verifikasi
                    <strong class="text-[#0F172A] font-medium">Editor</strong> sebelum tayang di halaman depan sekolah.
                </p>

                <dl class="mt-4 space-y-2.5 text-xs">
                    <div class="flex items-center justify-between py-1.5 border-b border-[#F1F5F9]">
                        <dt class="font-medium text-[#475569]">Draft</dt>
                        <dd class="text-[#64748B]">Disimpan penulis, belum diajukan</dd>
                    </div>
                    <div class="flex items-center justify-between py-1.5 border-b border-[#F1F5F9]">
                        <dt class="font-medium text-[#B45309]">Pending</dt>
                        <dd class="text-[#64748B]">Menunggu peninjauan editor</dd>
                    </div>
                    <div class="flex items-center justify-between py-1.5 border-b border-[#F1F5F9]">
                        <dt class="font-medium text-[#93000A]">Revision Needed</dt>
                        <dd class="text-[#64748B]">Dikembalikan dengan catatan revisi</dd>
                    </div>
                    <div class="flex items-center justify-between pt-1.5">
                        <dt class="font-medium text-[#047857]">Published</dt>
                        <dd class="text-[#64748B]">Tayang aktif di portal publik</dd>
                    </div>
                </dl>
            </section>
        </aside>
    </div>
@endsection
