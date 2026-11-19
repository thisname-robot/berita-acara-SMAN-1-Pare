@extends('layouts.admin')

@section('title', 'Manajemen Berita & Artikel — Portal Redaksi')
@section('breadcrumb', 'Manajemen Berita')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-8 border-b border-[#E2E8F0]">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.04em] text-[#64748B] mb-1.5">
                Pusat Konten Redaksi
            </p>
            <h1 class="font-display text-[26px] sm:text-[32px] font-bold text-[#0F172A] leading-[1.2] tracking-[-0.025em]">
                Daftar Berita & Artikel
            </h1>
        </div>

        <a href="{{ route('admin.articles.create') }}"
            class="min-h-[44px] px-4 py-2.5 rounded-lg bg-[#0F172A] text-white text-sm font-semibold hover:bg-[#1E293B] inline-flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Tulis Berita Baru</span>
        </a>
    </div>

    {{-- Filter & Search Bar --}}
    <div
        class="mt-6 bg-white rounded-lg border border-[#E2E8F0] p-4 shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)]">
        <form action="{{ route('admin.articles.index') }}" method="GET"
            class="flex flex-col sm:flex-row items-center gap-4">
            <div class="w-full sm:flex-1">
                <label for="search" class="sr-only">Cari Judul Berita</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan judul berita..."
                    class="w-full rounded-lg border border-[#CBD5E1] bg-white px-3.5 py-2 text-sm text-[#0F172A] placeholder-[#94A3B8] focus:border-[#0F172A] focus:ring-1 focus:ring-[#0F172A]">
            </div>

            <div class="w-full sm:w-48">
                <label for="status" class="sr-only">Filter Status</label>
                <select id="status" name="status"
                    class="w-full rounded-lg border border-[#CBD5E1] bg-white px-3 py-2 text-sm text-[#0F172A] focus:border-[#0F172A] focus:ring-1 focus:ring-[#0F172A]">
                    <option value="">Semua Status</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending Review</option>
                    <option value="revision_needed" {{ request('status') === 'revision_needed' ? 'selected' : '' }}>Perlu
                        Revisi</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published (Terbit)
                    </option>
                </select>
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button type="submit"
                    class="min-h-[42px] px-4 py-2 rounded-lg bg-[#0F172A] text-white text-xs font-semibold hover:bg-[#1E293B] transition-colors flex-1 sm:flex-none">
                    Saring
                </button>
                @if (request()->filled('search') || request()->filled('status'))
                    <a href="{{ route('admin.articles.index') }}"
                        class="min-h-[42px] px-3 py-2 rounded-lg border border-[#CBD5E1] bg-white text-xs font-semibold text-[#0F172A] hover:bg-[#F1F5F9] transition-colors flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Tabel Artikel --}}
    <div
        class="mt-6 bg-white rounded-lg border border-[#E2E8F0] shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)] overflow-hidden">
        @if ($articles->isEmpty())
            <div class="p-12 text-center">
                <p class="text-sm font-medium text-[#64748B]">Tidak ada artikel berita yang ditemukan.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-[#F8FAFC] border-b border-[#E2E8F0] text-[11px] font-semibold uppercase tracking-[0.04em] text-[#64748B]">
                            <th scope="col" class="py-3.5 px-6">Judul & Kategori</th>
                            <th scope="col" class="py-3.5 px-4">Penulis</th>
                            <th scope="col" class="py-3.5 px-4 text-center">Status</th>
                            <th scope="col" class="py-3.5 px-4 text-center">Tayangan</th>
                            <th scope="col" class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#F1F5F9] text-sm">
                        @foreach ($articles as $article)
                            @php
                                $statusBadge = match ($article->status) {
                                    'published' => [
                                        'label' => 'Published',
                                        'classes' => 'bg-[#ECFDF5] text-[#047857] border-[#A7F3D0]',
                                    ],
                                    'pending' => [
                                        'label' => 'Pending Review',
                                        'classes' => 'bg-[#FEF3C7] text-[#B45309] border-[#FDE68A]',
                                    ],
                                    'revision_needed' => [
                                        'label' => 'Perlu Revisi',
                                        'classes' => 'bg-[#FFEDED] text-[#93000A] border-[#FECACA]',
                                    ],
                                    default => [
                                        'label' => 'Draft',
                                        'classes' => 'bg-[#F1F5F9] text-[#475569] border-[#E2E8F0]',
                                    ],
                                };
                            @endphp
                            <tr class="hover:bg-[#F8FAFC] transition-colors">
                                <td class="py-4 px-6">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-[#F1F5F9] text-[#475569] border border-[#E2E8F0]">
                                                <span class="w-1.5 h-1.5 rounded-full shrink-0"
                                                    style="background-color: {{ $article->category->color_code ?? '#0F172A' }}"
                                                    aria-hidden="true"></span>
                                                {{ $article->category->name ?? 'Umum' }}
                                            </span>
                                            @if ($article->is_headline)
                                                <span
                                                    class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-[#0F172A] text-white">Headline</span>
                                            @endif
                                            @if ($article->is_breaking)
                                                <span
                                                    class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-[#FEF3C7] text-[#B45309] border border-[#FDE68A]">Breaking</span>
                                            @endif
                                        </div>
                                        <a href="{{ route('admin.articles.edit', $article) }}"
                                            class="font-display font-semibold text-[#0F172A] hover:underline block leading-snug">
                                            {{ $article->title }}
                                        </a>
                                        <span class="text-xs text-[#64748B] block">Dibuat:
                                            {{ $article->created_at->translatedFormat('d M Y, H:i') }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-xs font-medium text-[#475569]">
                                    {{ $article->user->name ?? 'Staf Redaksi' }}
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span
                                        class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold border {{ $statusBadge['classes'] }}">
                                        {{ $statusBadge['label'] }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-center text-xs tabular-nums text-[#0F172A] font-medium">
                                    {{ number_format($article->views_count, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.articles.edit', $article) }}"
                                            class="min-h-[36px] px-3 py-1.5 rounded-md border border-[#CBD5E1] bg-white text-xs font-semibold text-[#0F172A] hover:bg-[#F1F5F9] transition-colors">
                                            Sunting
                                        </a>
                                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                                            onsubmit="return confirm('Hapus artikel ini?')">
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-[#E2E8F0] bg-[#F8FAFC]">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
@endsection
