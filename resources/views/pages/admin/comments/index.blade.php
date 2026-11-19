@extends('layouts.admin')

@section('title', 'Moderasi Komentar Pembaca — Portal Redaksi')
@section('breadcrumb', 'Moderasi Komentar')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-8 border-b border-[#E2E8F0]">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.04em] text-[#64748B] mb-1.5">
                Pengawasan Interaksi Pembaca
            </p>
            <h1 class="font-display text-[26px] sm:text-[32px] font-bold text-[#0F172A] leading-[1.2] tracking-[-0.025em]">
                Moderasi Komentar
            </h1>
        </div>
    </div>

    {{-- Filter Status Moderasi --}}
    <div
        class="mt-6 bg-white rounded-lg border border-[#E2E8F0] p-4 shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)]">
        <form action="{{ route('admin.comments.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-4">
            <div class="w-full sm:w-64">
                <label for="status" class="sr-only">Filter Status Moderasi</label>
                <select id="status" name="status"
                    class="w-full rounded-lg border border-[#CBD5E1] bg-white px-3 py-2 text-sm text-[#0F172A] focus:border-[#0F172A] focus:ring-1 focus:ring-[#0F172A]">
                    <option value="">Semua Status Komentar</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Persetujuan
                        (Pending)</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui (Published)
                    </option>
                </select>
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button type="submit"
                    class="min-h-[42px] px-4 py-2 rounded-lg bg-[#0F172A] text-white text-xs font-semibold hover:bg-[#1E293B] transition-colors flex-1 sm:flex-none">
                    Terapkan Filter
                </button>
                @if (request()->filled('status'))
                    <a href="{{ route('admin.comments.index') }}"
                        class="min-h-[42px] px-3 py-2 rounded-lg border border-[#CBD5E1] bg-white text-xs font-semibold text-[#0F172A] hover:bg-[#F1F5F9] transition-colors flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Daftar Tabel Komentar --}}
    <div
        class="mt-6 bg-white rounded-lg border border-[#E2E8F0] shadow-[0_1px_3px_0_rgba(15,23,42,0.04),0_1px_2px_-1px_rgba(15,23,42,0.02)] overflow-hidden">
        @if ($comments->isEmpty())
            <div class="p-12 text-center">
                <p class="text-sm font-medium text-[#64748B]">Tidak ada komentar pembaca yang ditemukan.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-[#F8FAFC] border-b border-[#E2E8F0] text-[11px] font-semibold uppercase tracking-[0.04em] text-[#64748B]">
                            <th scope="col" class="py-3.5 px-6">Pengirim & Artikel Terkait</th>
                            <th scope="col" class="py-3.5 px-4">Isi Komentar</th>
                            <th scope="col" class="py-3.5 px-4 text-center">Status</th>
                            <th scope="col" class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#F1F5F9] text-sm">
                        @foreach ($comments as $comment)
                            <tr class="hover:bg-[#F8FAFC] transition-colors">
                                <td class="py-4 px-6 align-top">
                                    <div class="space-y-1">
                                        <p class="font-semibold text-[#0F172A]">{{ $comment->author_name }}</p>
                                        <p class="text-xs text-[#64748B] line-clamp-1">
                                            Artikel: <span
                                                class="font-medium text-[#475569]">{{ $comment->article->title ?? 'Artikel Dihapus' }}</span>
                                        </p>
                                        <time class="text-[11px] text-[#94A3B8]"
                                            datetime="{{ $comment->created_at->toIso8601String() }}">
                                            {{ $comment->created_at->translatedFormat('d M Y, H:i') }}
                                        </time>
                                    </div>
                                </td>
                                <td class="py-4 px-4 align-top text-[#475569] max-w-md">
                                    <p class="text-sm bg-[#F8FAFC] border border-[#E2E8F0] p-3 rounded-lg leading-relaxed">
                                        {{ $comment->content }}
                                    </p>
                                </td>
                                <td class="py-4 px-4 text-center align-top">
                                    @if ($comment->is_approved)
                                        <span
                                            class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold bg-[#ECFDF5] text-[#047857] border border-[#A7F3D0]">
                                            Disetujui
                                        </span>
                                    @else
                                        <span
                                            class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold bg-[#FEF3C7] text-[#B45309] border border-[#FDE68A]">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right align-top">
                                    <div class="flex items-center justify-end gap-2">
                                        {{-- Tombol Toggle Approve / Hide --}}
                                        <form action="{{ route('admin.comments.update', $comment) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="min-h-[36px] px-3 py-1.5 rounded-md border border-[#CBD5E1] bg-white text-xs font-semibold text-[#0F172A] hover:bg-[#F1F5F9] transition-colors">
                                                {{ $comment->is_approved ? 'Sembunyikan' : 'Setujui' }}
                                            </button>
                                        </form>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST"
                                            onsubmit="return confirm('Hapus komentar ini secara permanen?')">
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

            <div class="p-4 border-t border-[#E2E8F0] bg-[#F8FAFC]">
                {{ $comments->links() }}
            </div>
        @endif
    </div>
@endsection
