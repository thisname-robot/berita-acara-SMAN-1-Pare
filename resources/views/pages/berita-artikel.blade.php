@extends('layouts.app')

@section('title', 'Warta & Kabar Sekolah - SMAN 1 Pare')

@section('content')
<div class="flex flex-col w-full">
  <!-- ============ TOP CONTEXT HEADER & FILTER ============ -->
  <section class="w-full bg-surface-container-low py-space-lg">
    <div class="max-w-7xl mx-auto px-gutter-mobile lg:px-gutter flex flex-col gap-space-md">
      <nav class="flex items-center gap-space-xs font-label-sm text-label-sm text-on-surface-variant" aria-label="Breadcrumb">
        <a class="hover:text-on-surface transition-colors" href="{{ route('home') }}">Beranda</a>
        <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
        <span class="text-on-surface">Warta &amp; Publikasi</span>
      </nav>

      <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md">
        <div class="max-w-3xl flex flex-col gap-space-xs">
          <span class="font-label-sm text-label-sm text-secondary tracking-wider uppercase font-semibold">Kanal Informasi Terpadu</span>
          <h1 class="font-headline-lg-mobile lg:font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-on-surface tracking-tight">
            Warta &amp; Kabar Sekolah SMAN 1 Pare
          </h1>
          <p class="font-body-md text-body-md text-on-surface-variant mt-1">
            Pusat rilis pers resmi, jurnalistik siswa, surat edaran akademik, serta arsip dokumentasi pencapaian insan civitas akademika SMAN 1 Pare.
          </p>
        </div>
        <div class="shrink-0 flex items-center gap-space-xs bg-surface-container-lowest px-space-md py-space-sm rounded-lg shadow-sm self-start md:self-auto">
          <span class="material-symbols-outlined text-[18px] text-secondary">calendar_today</span>
          <span class="font-label-md text-label-md text-on-surface">T.A. 2025/2026 (Semester Ganjil)</span>
        </div>
      </div>

      <!-- Form Pencarian & Filter Kategori -->
      <form action="{{ route('home') }}" method="GET" class="mt-space-sm p-space-sm bg-surface-container-lowest rounded-xl shadow-sm flex flex-col sm:flex-row items-stretch sm:items-center gap-space-sm">
        <div class="flex-1 w-full flex items-center gap-space-sm px-space-md py-2 bg-surface-container-low rounded-lg">
          <span class="material-symbols-outlined text-[20px] text-on-surface-variant">search</span>
          <input
            name="q"
            value="{{ request('q') }}"
            class="w-full bg-transparent font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none"
            placeholder="Cari topik, nama kegiatan, atau pengumuman..."
            type="text"
          />
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-space-sm w-full sm:w-auto">
          <div class="relative w-full sm:w-64">
            <select name="kategori" class="w-full appearance-none bg-surface-container-low text-on-surface font-label-md text-label-md px-space-md py-2.5 rounded-lg pr-9 focus:outline-none cursor-pointer">
              <option value="all">Semua Kategori Warta</option>
              @foreach ($categories as $cat)
                <option value="{{ $cat->slug }}" @selected(request('kategori') === $cat->slug)>
                  {{ $cat->name }}
                </option>
              @endforeach
            </select>
            <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-[18px] text-on-surface-variant pointer-events-none">expand_more</span>
          </div>
          <button type="submit" class="shrink-0 bg-primary text-on-primary font-label-md text-label-md px-space-lg py-2.5 rounded-lg hover:bg-surface-container-highest hover:text-on-surface transition-colors flex items-center justify-center gap-space-xs cursor-pointer">
            <span class="material-symbols-outlined text-[18px]">filter_list</span>
            <span>Terapkan</span>
          </button>
        </div>
      </form>
    </div>
  </section>

  <!-- ============ MAIN CONTAINER ============ -->
  <div class="max-w-7xl mx-auto px-gutter-mobile lg:px-gutter w-full py-space-lg lg:py-space-xl flex flex-col gap-space-lg lg:gap-space-xl">

    <!-- 1. Featured Lead Story (Headline dari Database) -->
    @if ($headlineArticle)
      <section class="w-full">
        <div class="flex flex-wrap items-center justify-between gap-space-xs mb-space-md">
          <div class="flex items-center gap-space-sm">
            <span class="w-2.5 h-2.5 rounded-full bg-error animate-pulse"></span>
            <span class="font-label-sm text-label-sm text-on-surface tracking-wider uppercase font-semibold">Sorotan Utama Humas</span>
          </div>
          <span class="font-code-inline text-code-inline text-on-surface-variant">
            RILIS PERS #SMANSA-{{ $headlineArticle->published_at?->format('Y') }}-{{ str_pad($headlineArticle->id, 2, '0', STR_PAD_LEFT) }}
          </span>
        </div>

        <article class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden grid grid-cols-1 lg:grid-cols-12 group transition-shadow duration-200 hover:shadow-md">
          <div class="lg:col-span-7 relative min-h-[220px] sm:min-h-[320px] lg:min-h-[460px] bg-surface-container-high overflow-hidden">
            <div
              class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
              role="img"
              aria-label="{{ $headlineArticle->title }}"
              style="background-image: url('{{ $headlineArticle->thumbnail_url }}');"
            ></div>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent lg:hidden"></div>
            <div class="absolute bottom-3 left-3 bg-surface-container-lowest/95 backdrop-blur-sm px-space-md py-1.5 rounded text-on-surface font-label-sm text-label-sm shadow-sm flex items-center gap-space-xs">
              <span class="material-symbols-outlined text-[16px] text-secondary">photo_camera</span>
              <span>{{ $headlineArticle->category->name ?? 'Warta Sekolah' }}</span>
            </div>
          </div>

          <div class="lg:col-span-5 p-space-lg lg:p-space-xl flex flex-col justify-between bg-surface-container-lowest">
            <div class="flex flex-col gap-space-md">
              <div class="flex flex-wrap items-center gap-space-sm">
                <span
                  class="px-space-md py-1 rounded-full font-label-sm text-label-sm font-semibold text-white"
                  style="background-color: {{ $headlineArticle->category->color_code ?? '#0055A5' }}"
                >
                  {{ $headlineArticle->category->name ?? 'Umum' }}
                </span>
                <span class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1">
                  <span class="material-symbols-outlined text-[16px]">schedule</span>
                  {{ $headlineArticle->published_at?->translatedFormat('d F Y') }}
                </span>
                <span class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1">
                  <span class="material-symbols-outlined text-[16px]">timer</span>
                  {{ $headlineArticle->read_time }}
                </span>
              </div>
              <h2 class="font-headline-md text-headline-md text-on-surface tracking-tight leading-snug">
                <a href="{{ route('berita.show', $headlineArticle->slug) }}" class="hover:text-secondary transition-colors">
                  {{ $headlineArticle->title }}
                </a>
              </h2>
              <p class="font-body-md text-body-md text-on-surface-variant line-clamp-4">
                {{ $headlineArticle->excerpt }}
              </p>
            </div>
            <div class="pt-space-lg mt-space-md flex flex-col sm:flex-row sm:items-center justify-between gap-space-md">
              <div class="flex items-center gap-space-sm">
                <div class="w-9 h-9 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface overflow-hidden">
                  @if ($headlineArticle->user?->avatar)
                    <img src="{{ asset('storage/' . $headlineArticle->user->avatar) }}" alt="{{ $headlineArticle->user->name }}" class="w-full h-full object-cover">
                  @else
                    <span class="material-symbols-outlined text-[20px]">edit_note</span>
                  @endif
                </div>
                <div class="flex flex-col">
                  <span class="font-label-sm text-label-sm text-on-surface">{{ $headlineArticle->user->name ?? 'Tim Redaksi' }}</span>
                  <span class="font-code-inline text-code-inline text-on-surface-variant capitalize">{{ $headlineArticle->user->role ?? 'Humas' }}</span>
                </div>
              </div>
              <div class="flex items-center gap-space-xs self-end sm:self-auto">
                <button type="button" data-bookmark class="bookmark-btn p-2 text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low rounded-lg transition-colors cursor-pointer" title="Simpan Artikel">
                  <span class="material-symbols-outlined text-[20px]">bookmark_border</span>
                </button>
                <a class="inline-flex items-center gap-space-xs bg-primary text-on-primary font-label-md text-label-md px-space-lg py-2.5 rounded-lg hover:bg-surface-container-highest hover:text-on-surface transition-colors cursor-pointer" href="{{ route('berita.show', $headlineArticle->slug) }}">
                  <span>Baca Selengkapnya</span>
                  <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
              </div>
            </div>
          </div>
        </article>
      </section>
    @endif

    <!-- 2. Pill Tabs & Sort Bar -->
    <section class="w-full flex flex-col sm:flex-row sm:items-center justify-between gap-space-md">
      <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0 -mx-1 px-1">
        <a
          href="{{ route('home', array_merge(request()->except('page'), ['kategori' => 'all'])) }}"
          class="px-space-md py-2 rounded-full font-label-md text-label-md shrink-0 whitespace-nowrap transition-colors {{ (!request('kategori') || request('kategori') === 'all') ? 'bg-surface-container-highest text-on-surface font-semibold' : 'bg-surface-container-low text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}"
        >
          Semua ({{ $totalPublished }})
        </a>
        @foreach ($categories as $cat)
          <a
            href="{{ route('home', array_merge(request()->except('page'), ['kategori' => $cat->slug])) }}"
            class="px-space-md py-2 rounded-full font-label-md text-label-md shrink-0 whitespace-nowrap transition-colors {{ request('kategori') === $cat->slug ? 'bg-surface-container-highest text-on-surface font-semibold' : 'bg-surface-container-low text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}"
          >
            {{ $cat->name }} ({{ $cat->articles_count }})
          </a>
        @endforeach
      </div>

      <form action="{{ route('home') }}" method="GET" class="flex items-center gap-space-sm self-end sm:self-auto shrink-0">
        @if (request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
        @if (request('kategori')) <input type="hidden" name="kategori" value="{{ request('kategori') }}"> @endif
        <span class="font-label-sm text-label-sm text-on-surface-variant">Urutkan:</span>
        <div class="relative">
          <select name="sort" onchange="this.form.submit()" class="appearance-none bg-surface-container-lowest text-on-surface font-label-md text-label-md px-space-md py-1.5 rounded-lg pr-8 shadow-sm cursor-pointer focus:outline-none">
            <option value="latest" @selected(request('sort', 'latest') === 'latest')>Terbaru</option>
            <option value="popular" @selected(request('sort') === 'popular')>Paling Banyak Dibaca</option>
            <option value="oldest" @selected(request('sort') === 'oldest')>Terlama</option>
          </select>
          <span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-[16px] text-on-surface-variant pointer-events-none">expand_more</span>
        </div>
      </form>
    </section>

    <!-- 3. Asymmetric Content Grid + Sidebar -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg lg:gap-space-xl items-start">
      <!-- Articles Column -->
      <div class="lg:col-span-8 flex flex-col gap-space-lg min-w-0">
        @forelse ($articles as $article)
          <article class="article-card bg-surface-container-lowest rounded-xl p-space-md sm:p-space-lg shadow-sm hover:shadow-md transition-shadow flex flex-col sm:flex-row gap-space-md sm:gap-space-lg">
            <div class="sm:w-56 h-48 sm:h-auto rounded-lg overflow-hidden shrink-0 bg-surface-container-high relative">
              <a href="{{ route('berita.show', $article->slug) }}" class="block w-full h-full">
                <div
                  class="w-full h-full bg-cover bg-center hover:scale-105 transition-transform duration-300"
                  role="img"
                  aria-label="{{ $article->title }}"
                  style="background-image: url('{{ $article->thumbnail_url }}');"
                ></div>
              </a>
              <span
                class="absolute top-2 left-2 px-2 py-0.5 rounded text-[11px] font-semibold uppercase text-white tracking-wider"
                style="background-color: {{ $article->category->color_code ?? '#0055A5' }}"
              >
                {{ $article->category->name ?? 'Berita' }}
              </span>
            </div>
            <div class="flex-1 flex flex-col justify-between min-w-0">
              <div class="flex flex-col gap-space-xs">
                <div class="flex flex-wrap items-center gap-space-sm text-on-surface-variant font-body-sm text-body-sm">
                  <span>{{ $article->published_at?->translatedFormat('d M Y') }}</span>
                  <span aria-hidden="true">•</span>
                  <span>{{ $article->read_time }}</span>
                  <span aria-hidden="true">•</span>
                  <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">visibility</span>
                    {{ number_format($article->views_count) }}
                  </span>
                </div>
                <h3 class="font-headline-sm text-headline-sm text-on-surface tracking-tight hover:text-secondary cursor-pointer">
                  <a href="{{ route('berita.show', $article->slug) }}">{{ $article->title }}</a>
                </h3>
                <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                  {{ $article->excerpt }}
                </p>
              </div>
              <div class="mt-space-md pt-space-sm flex flex-wrap items-center justify-between gap-space-xs">
                <div class="flex items-center gap-space-xs text-on-surface-variant font-label-sm text-label-sm">
                  <span class="material-symbols-outlined text-[16px]">person</span>
                  <span>Oleh: {{ $article->user->name ?? 'Redaksi' }}</span>
                </div>
                <a class="font-label-md text-label-md text-primary font-semibold hover:underline flex items-center gap-1" href="{{ route('berita.show', $article->slug) }}">
                  <span>Selengkapnya</span>
                  <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
              </div>
            </div>
          </article>
        @empty
          <div class="bg-surface-container-lowest rounded-xl p-space-xl text-center shadow-sm">
            <span class="material-symbols-outlined text-[40px] text-outline mb-2">article</span>
            <p class="font-body-md text-body-md text-on-surface-variant">Belum ada berita atau artikel yang dipublikasikan.</p>
          </div>
        @endforelse

        <!-- Pagination Laravel -->
        @if ($articles->hasPages())
          <div class="mt-space-md">
            {{ $articles->links() }}
          </div>
        @endif
      </div>

      <!-- Sidebar -->
      <aside class="lg:col-span-4 flex flex-col gap-space-lg">
        <!-- Breaking News / Pengumuman Penting -->
        <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm flex flex-col gap-space-md">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-space-xs">
              <span class="material-symbols-outlined text-[20px] text-error">campaign</span>
              <h2 class="font-title-md text-title-md text-on-surface">Kabar Penting &amp; Breaking</h2>
            </div>
            <span class="px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">Resmi</span>
          </div>
          <div class="flex flex-col gap-space-sm">
            @forelse ($breakingNews as $item)
              <a class="p-space-sm rounded-lg bg-surface-container-low hover:bg-surface-container transition-colors flex flex-col gap-1" href="{{ route('berita.show', $item->slug) }}">
                <div class="flex items-center justify-between gap-space-xs">
                  <span class="px-2 py-0.5 rounded bg-error text-on-error font-label-sm text-[11px] font-semibold">
                    {{ $item->category->name ?? 'Penting' }}
                  </span>
                  <span class="font-code-inline text-code-inline text-on-surface-variant">
                    {{ $item->published_at?->translatedFormat('d M Y') }}
                  </span>
                </div>
                <h3 class="font-label-md text-label-md text-on-surface font-semibold mt-1">{{ $item->title }}</h3>
                <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">{{ $item->excerpt }}</p>
              </a>
            @empty
              <p class="font-body-sm text-body-sm text-on-surface-variant">Tidak ada pengumuman mendesak saat ini.</p>
            @endforelse
          </div>
        </div>

        <!-- Kontak Humas -->
        <div class="bg-surface-container-low rounded-xl p-space-lg flex flex-col gap-space-sm">
          <span class="font-title-md text-title-md text-on-surface">Kontak Hubungan Masyarakat</span>
          <p class="font-body-sm text-body-sm text-on-surface-variant">Untuk keperluan liputan media eksternal, konfirmasi prestasi, atau permintaan wawancara dinas:</p>
          <div class="flex flex-col gap-1 text-on-surface font-label-md text-label-md mt-1">
            <span class="flex items-center gap-2 break-all">
              <span class="material-symbols-outlined text-[18px] text-secondary shrink-0">mail</span>humas@sman1pare.sch.id
            </span>
            <span class="flex items-center gap-2">
              <span class="material-symbols-outlined text-[18px] text-secondary shrink-0">phone_iphone</span>(0354) 391132 ext. 104
            </span>
          </div>
        </div>
      </aside>
    </div>
  </div>
</div>
@endsection
