@extends('layouts.app')

@section('title', $article->title . ' - SMAN 1 Pare')

@section('content')
    <div class="flex flex-col w-full">
        <!-- ============ BREADCRUMB & HEADER ============ -->
        <section class="w-full bg-surface-container-low py-space-lg">
            <div class="max-w-4xl mx-auto px-gutter-mobile lg:px-gutter flex flex-col gap-space-sm">
                <nav class="flex items-center gap-space-xs font-label-sm text-label-sm text-on-surface-variant"
                    aria-label="Breadcrumb">
                    <a class="hover:text-on-surface transition-colors" href="{{ route('home') }}">Beranda</a>
                    <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
                    <a class="hover:text-on-surface transition-colors" href="{{ route('home') }}">Warta &amp; Publikasi</a>
                    <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
                    <span class="text-on-surface line-clamp-1">{{ $article->title }}</span>
                </nav>

                <div class="flex flex-wrap items-center gap-space-sm mt-2">
                    <span class="px-space-md py-1 rounded-full font-label-sm text-label-sm font-semibold text-white"
                        style="background-color: {{ $article->category->color_code ?? '#0055A5' }}">
                        {{ $article->category->name ?? 'Warta Sekolah' }}
                    </span>
                    <span class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">schedule</span>
                        {{ $article->published_at?->translatedFormat('d F Y, H:i') }} WIB
                    </span>
                    <span class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">timer</span>
                        {{ $article->read_time }}
                    </span>
                    <span class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                        {{ number_format($article->views_count) }} kali dibaca
                    </span>
                </div>

                <h1
                    class="font-headline-lg-mobile lg:font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-on-surface tracking-tight mt-1 leading-snug">
                    {{ $article->title }}
                </h1>

                <!-- Info Penulis / Humas -->
                <div class="flex items-center justify-between pt-space-md border-t border-outline-variant/30 mt-space-sm">
                    <div class="flex items-center gap-space-sm">
                        <div
                            class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface overflow-hidden">
                            @if ($article->user?->avatar)
                                <img src="{{ asset('storage/' . $article->user->avatar) }}"
                                    alt="{{ $article->user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-[20px]">person</span>
                            @endif
                        </div>
                        <div class="flex flex-col">
                            <span
                                class="font-label-md text-label-md text-on-surface font-semibold">{{ $article->user->name ?? 'Tim Redaksi SMANSA' }}</span>
                            <span
                                class="font-body-sm text-body-sm text-on-surface-variant capitalize">{{ $article->user->role ?? 'Humas & Publikasi SMAN 1 Pare' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-space-xs">
                        <button type="button" data-bookmark
                            class="bookmark-btn p-2 text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low rounded-lg transition-colors cursor-pointer"
                            title="Simpan Artikel">
                            <span class="material-symbols-outlined text-[20px]">bookmark_border</span>
                        </button>
                        <button type="button"
                            onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan artikel berhasil disalin ke clipboard!');"
                            class="p-2 text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low rounded-lg transition-colors cursor-pointer"
                            title="Bagikan / Salin Tautan">
                            <span class="material-symbols-outlined text-[20px]">share</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ MAIN ARTICLE BODY ============ -->
        <div class="max-w-4xl mx-auto px-gutter-mobile lg:px-gutter w-full py-space-xl flex flex-col gap-space-xl">
            <!-- Thumbnail Utama -->
            @if ($article->thumbnail)
                <div class="w-full h-[320px] sm:h-[450px] rounded-2xl overflow-hidden bg-surface-container-high shadow-sm">
                    <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}"
                        class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Konten Artikel -->
            <article
                class="bg-surface-container-lowest rounded-2xl p-space-lg sm:p-space-xl shadow-sm prose max-w-none text-on-surface font-body-lg text-body-lg leading-relaxed flex flex-col gap-4">
                {!! $article->content !!}
            </article>

            <!-- Tags & Share -->
            @if ($article->tags->count() > 0)
                <div class="flex flex-wrap items-center gap-2 pt-2">
                    <span class="font-label-md text-label-md text-on-surface-variant mr-2 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[18px]">tag</span> Topik:
                    </span>
                    @foreach ($article->tags as $tag)
                        <span
                            class="px-space-md py-1 rounded-lg bg-surface-container-low text-on-surface font-label-sm text-label-sm">
                            #{{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            @endif

            <section class="pt-space-lg border-t border-outline-variant/30 flex flex-col gap-space-lg"
                id="komentar-section">
                <div class="flex items-center justify-between">
                    <h3 class="font-headline-md text-headline-md text-on-surface">
                        Komentar Pembaca ({{ $article->approvedComments->count() }})
                    </h3>
                </div>

                {{-- Notifikasi Status Berhasil --}}
                @if (session('status'))
                    <div role="status"
                        class="rounded-xl bg-[#ECFDF5] border border-[#A7F3D0] px-4 py-3 text-sm text-[#047857] flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                {{-- Form Kirim Komentar --}}
                <form action="{{ route('berita.comment.store', $article->slug) }}" method="POST"
                    class="bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm flex flex-col gap-space-md">
                    @csrf
                    <h4 class="font-title-md text-title-md text-on-surface">Tinggalkan Tanggapan</h4>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Komentar akan melalui proses peninjauan
                        (moderasi) oleh admin sebelum dipublikasikan ke halaman portal.</p>

                    <div class="flex flex-col gap-space-xs">
                        <label for="author_name" class="font-label-md text-label-md text-on-surface font-semibold">Nama /
                            Identitas <span class="text-error">*</span></label>
                        <input type="text" id="author_name" name="author_name" value="{{ old('author_name') }}" required
                            placeholder="Contoh: Budi Santoso (Siswa / Orang Tua)"
                            class="rounded-lg border border-outline-variant/50 bg-surface-container-low px-4 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary">
                        @error('author_name')
                            <span class="text-xs text-error mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-space-xs">
                        <label for="content" class="font-label-md text-label-md text-on-surface font-semibold">Pesan
                            Komentar <span class="text-error">*</span></label>
                        <textarea id="content" name="content" rows="4" required
                            placeholder="Tuliskan tanggapan, apresiasi, atau masukan Anda..."
                            class="rounded-lg border border-outline-variant/50 bg-surface-container-low px-4 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary">{{ old('content') }}</textarea>
                        @error('content')
                            <span class="text-xs text-error mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit"
                        class="self-end bg-primary text-on-primary font-label-md text-label-md px-space-lg py-2.5 rounded-lg hover:bg-surface-container-highest hover:text-on-surface transition-colors cursor-pointer flex items-center gap-space-xs">
                        <span class="material-symbols-outlined text-[18px]">send</span>
                        <span>Kirim Komentar</span>
                    </button>
                </form>

                {{-- Daftar Komentar yang Sudah Disetujui --}}
                <div class="flex flex-col gap-space-md mt-2">
                    @forelse ($article->approvedComments as $comment)
                        <div
                            class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm flex flex-col gap-2 border border-outline-variant/20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center font-bold text-xs text-on-surface">
                                        {{ strtoupper(substr($comment->author_name, 0, 1)) }}
                                    </div>
                                    <span
                                        class="font-label-md text-label-md text-on-surface font-semibold">{{ $comment->author_name }}</span>
                                </div>
                                <span class="font-code-inline text-code-inline text-on-surface-variant text-xs">
                                    {{ $comment->created_at->translatedFormat('d M Y, H:i') }}
                                </span>
                            </div>
                            <p class="font-body-md text-body-md text-on-surface-variant pl-10">
                                {{ $comment->content }}
                            </p>
                        </div>
                    @empty
                        <div class="bg-surface-container-low rounded-xl p-space-lg text-center">
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Belum ada komentar publik pada
                                artikel ini. Jadilah yang pertama memberikan tanggapan!</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- Related Articles / Berita Terkait -->
            @if ($relatedArticles->count() > 0)
                <div class="pt-space-lg border-t border-outline-variant/30 flex flex-col gap-space-lg">
                    <h3 class="font-headline-md text-headline-md text-on-surface">Berita Terkait Lainnya</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
                        @foreach ($relatedArticles as $related)
                            <div
                                class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm flex flex-col justify-between gap-space-sm hover:shadow-md transition-shadow">
                                <div class="flex flex-col gap-space-xs">
                                    <div class="h-36 rounded-lg overflow-hidden bg-surface-container-high mb-1">
                                        <img src="{{ $related->thumbnail_url }}" alt="{{ $related->title }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <span
                                        class="text-[11px] font-semibold text-on-surface-variant">{{ $related->published_at?->translatedFormat('d M Y') }}</span>
                                    <h4
                                        class="font-title-md text-title-md text-on-surface line-clamp-2 hover:text-secondary">
                                        <a href="{{ route('berita.show', $related->slug) }}">{{ $related->title }}</a>
                                    </h4>
                                </div>
                                <a href="{{ route('berita.show', $related->slug) }}"
                                    class="font-label-md text-label-md text-primary font-semibold flex items-center gap-1 mt-2">
                                    <span>Baca</span>
                                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
