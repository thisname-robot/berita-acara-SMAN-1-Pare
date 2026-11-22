@extends('layouts.admin')

@section('title', 'Manajemen Menu & Sub-Menu — Portal Redaksi')
@section('breadcrumb', 'Menu Portal')

@section('content')
    <div x-data="{
        editModalOpen: false,
        editAction: '',
        editForm: {
            id: null,
            parent_id: '',
            label: '',
            url: '',
            order: 0,
            open_in_new_tab: false,
            has_children: false
        },
        openEditModal(menu, updateUrl, hasChildren = false) {
            this.editForm = {
                id: menu.id,
                parent_id: menu.parent_id ? String(menu.parent_id) : '',
                label: menu.label,
                url: menu.url,
                order: menu.order ?? 0,
                open_in_new_tab: Boolean(menu.open_in_new_tab),
                has_children: hasChildren
            };
            this.editAction = updateUrl;
            this.editModalOpen = true;
        }
    }" @keydown.escape.window="editModalOpen = false">

        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-8 border-b border-[#E2E8F0]">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.04em] text-[#64748B] mb-1.5">
                    Struktur Navigasi Halaman Utama
                </p>
                <h1
                    class="font-display text-[26px] sm:text-[32px] font-bold text-[#0F172A] leading-[1.2] tracking-[-0.025em]">
                    Manajemen Menu &amp; Sub-Menu
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
            {{-- Kolom Kiri: Form Tambah Menu / Sub-Menu (4 Kolom) --}}
            <section aria-labelledby="form-menu-heading"
                class="lg:col-span-4 bg-white rounded-lg border border-[#E2E8F0] p-6 shadow-sm">
                <h2 id="form-menu-heading" class="font-display text-base font-semibold text-[#0F172A]">
                    Tambah Menu / Sub-Menu
                </h2>
                <p class="mt-0.5 text-xs text-[#64748B]">
                    Pilih menu induk jika ingin menjadikannya sebagai item dropdown (sub-menu).
                </p>

                <form action="{{ route('admin.menus.store') }}" method="POST" class="mt-5 space-y-4">
                    @csrf

                    <div>
                        <label for="parent_id" class="block text-xs font-semibold text-[#0F172A] mb-1.5">
                            Posisi / Menu Induk
                        </label>
                        <select id="parent_id" name="parent_id"
                            class="w-full rounded-lg border border-[#CBD5E1] bg-white px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A]">
                            <option value="">-- Jadikan Menu Utama (Top Level) --</option>
                            @foreach ($parentOptions as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                    Sub-menu dari: {{ $parent->label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

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
                            placeholder="https://sims.sman1pare.sch.id atau #"
                            class="w-full rounded-lg border border-[#CBD5E1] px-3.5 py-2.5 text-sm text-[#0F172A] placeholder-[#94A3B8] focus:border-[#0F172A]">
                        <p class="mt-1 text-[11px] text-[#64748B]">Isi <code class="bg-[#F1F5F9] px-1 rounded">#</code> jika
                            menu utama hanya berfungsi sebagai pemicu dropdown sub-menu.</p>
                    </div>

                    <div>
                        <label for="order" class="block text-xs font-semibold text-[#0F172A] mb-1.5">
                            Urutan Tampil
                        </label>
                        <input type="number" id="order" name="order" value="{{ old('order', 1) }}" min="0"
                            class="w-full rounded-lg border border-[#CBD5E1] px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A]">
                    </div>

                    <div class="pt-1">
                        <label class="flex items-center gap-2.5 text-xs font-medium text-[#0F172A]">
                            <input type="checkbox" name="open_in_new_tab" value="1"
                                {{ old('open_in_new_tab') ? 'checked' : '' }}
                                class="rounded border-[#CBD5E1] text-[#0F172A] focus:ring-[#0F172A]">
                            <span>Buka di tab baru</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="min-h-[44px] w-full px-4 py-2.5 rounded-lg bg-[#0F172A] text-white text-sm font-semibold hover:bg-[#1E293B] transition-colors">
                        Simpan Menu
                    </button>
                </form>
            </section>

            {{-- Kolom Kanan: Tabel Hierarki Menu & Sub-Menu (8 Kolom) --}}
            <section aria-labelledby="tabel-menu-heading"
                class="lg:col-span-8 bg-white rounded-lg border border-[#E2E8F0] shadow-sm overflow-hidden">
                <div class="p-6 border-b border-[#F1F5F9]">
                    <h2 id="tabel-menu-heading" class="font-display text-base font-semibold text-[#0F172A]">
                        Struktur Menu Navigasi Portal
                    </h2>
                    <p class="mt-0.5 text-xs text-[#64748B]">
                        Klik tombol Edit untuk mengubah label, URL tujuan, posisi induk, maupun urutan tampil.
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
                                    <th scope="col" class="py-3.5 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#F1F5F9] text-sm">
                                @foreach ($menus as $menu)
                                    {{-- Baris Menu Utama --}}
                                    <tr class="bg-white hover:bg-[#F8FAFC] transition-colors">
                                        <td class="py-4 px-6 font-mono text-xs font-semibold text-[#0F172A]">
                                            #{{ $menu->order }}
                                        </td>
                                        <td class="py-4 px-4">
                                            <p class="font-semibold text-[#0F172A] flex flex-wrap items-center gap-2">
                                                <span>{{ $menu->label }}</span>
                                                @if ($menu->children->isNotEmpty())
                                                    <span
                                                        class="text-[10px] px-2 py-0.5 rounded-full bg-[#FEF3C7] text-[#B45309] border border-[#FDE68A]">
                                                        {{ $menu->children->count() }} Sub-menu
                                                    </span>
                                                @endif
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
                                                    class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold bg-[#ECFDF5] text-[#047857] border border-[#A7F3D0]">Aktif</span>
                                            @else
                                                <span
                                                    class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold bg-[#F1F5F9] text-[#475569] border border-[#E2E8F0]">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <div class="flex items-center justify-end gap-1.5">
                                                {{-- Tombol Edit --}}
                                                <button type="button"
                                                    @click="openEditModal({{ Js::from($menu->only(['id', 'parent_id', 'label', 'url', 'order', 'open_in_new_tab'])) }}, '{{ route('admin.menus.update', $menu) }}', {{ $menu->children->isNotEmpty() ? 'true' : 'false' }})"
                                                    class="min-w-[36px] min-h-[36px] rounded-md border border-[#CBD5E1] bg-white text-[#0F172A] hover:bg-[#F1F5F9] inline-flex items-center justify-center transition-colors"
                                                    title="Edit menu {{ $menu->label }}"
                                                    aria-label="Edit menu {{ $menu->label }}">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.75" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                </button>

                                                {{-- Tombol Toggle Sembunyikan / Tampilkan --}}
                                                <form action="{{ route('admin.menus.toggle', $menu) }}" method="POST"
                                                    class="inline-flex">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="min-w-[36px] min-h-[36px] rounded-md border border-[#CBD5E1] bg-white text-[#475569] hover:text-[#0F172A] hover:bg-[#F1F5F9] inline-flex items-center justify-center transition-colors"
                                                        title="{{ $menu->is_active ? 'Sembunyikan menu ' . $menu->label : 'Tampilkan menu ' . $menu->label }}"
                                                        aria-label="{{ $menu->is_active ? 'Sembunyikan menu ' . $menu->label : 'Tampilkan menu ' . $menu->label }}">
                                                        @if ($menu->is_active)
                                                            {{-- Ikon Mata Terbuka (Aktif / Sembunyikan) --}}
                                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                                stroke-width="1.75" stroke="currentColor"
                                                                aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            </svg>
                                                        @else
                                                            {{-- Ikon Mata Tertutup (Nonaktif / Tampilkan) --}}
                                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                                stroke-width="1.75" stroke="currentColor"
                                                                aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                                            </svg>
                                                        @endif
                                                    </button>
                                                </form>

                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST"
                                                    onsubmit="return confirm('Hapus menu {{ $menu->label }} beserta seluruh sub-menunya?')"
                                                    class="inline-flex">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="min-w-[36px] min-h-[36px] rounded-md text-[#BA1A1A] hover:bg-[#FEF2F2] inline-flex items-center justify-center transition-colors"
                                                        title="Hapus menu {{ $menu->label }}"
                                                        aria-label="Hapus menu {{ $menu->label }}">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.75" stroke="currentColor" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Baris Sub-Menu (Indentasi) --}}
                                    @foreach ($menu->children as $child)
                                        <tr class="bg-[#F8FAFC]/70 hover:bg-[#F1F5F9]/70 transition-colors">
                                            <td class="py-3 px-6 pl-10 font-mono text-xs text-[#64748B]">
                                                └ #{{ $child->order }}
                                            </td>
                                            <td class="py-3 px-4 pl-6">
                                                <p class="font-medium text-[#0F172A] flex flex-wrap items-center gap-1.5">
                                                    <span>{{ $child->label }}</span>
                                                    @if ($child->open_in_new_tab)
                                                        <span
                                                            class="text-[10px] px-1.5 py-0.5 rounded bg-white text-[#475569] border border-[#E2E8F0]">Tab
                                                            Baru</span>
                                                    @endif
                                                </p>
                                                <p class="text-xs text-[#64748B] truncate max-w-xs">{{ $child->url }}
                                                </p>
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                @if ($child->is_active)
                                                    <span
                                                        class="inline-block px-2 py-0.5 rounded-full text-[11px] font-semibold bg-[#ECFDF5] text-[#047857] border border-[#A7F3D0]">Aktif</span>
                                                @else
                                                    <span
                                                        class="inline-block px-2 py-0.5 rounded-full text-[11px] font-semibold bg-white text-[#475569] border border-[#E2E8F0]">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-6 text-right">
                                                <div class="flex items-center justify-end gap-1.5">
                                                    {{-- Tombol Edit Sub-Menu --}}
                                                    <button type="button"
                                                        @click="openEditModal({{ Js::from($child->only(['id', 'parent_id', 'label', 'url', 'order', 'open_in_new_tab'])) }}, '{{ route('admin.menus.update', $child) }}', false)"
                                                        class="min-w-[32px] min-h-[32px] rounded-md border border-[#CBD5E1] bg-white text-[#0F172A] hover:bg-[#F1F5F9] inline-flex items-center justify-center transition-colors"
                                                        title="Edit sub-menu {{ $child->label }}"
                                                        aria-label="Edit sub-menu {{ $child->label }}">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.75" stroke="currentColor" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                    </button>

                                                    {{-- Tombol Toggle Sembunyikan / Tampilkan Sub-Menu --}}
                                                    <form action="{{ route('admin.menus.toggle', $child) }}"
                                                        method="POST" class="inline-flex">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="min-w-[32px] min-h-[32px] rounded-md border border-[#CBD5E1] bg-white text-[#475569] hover:text-[#0F172A] hover:bg-[#F1F5F9] inline-flex items-center justify-center transition-colors"
                                                            title="{{ $child->is_active ? 'Sembunyikan sub-menu ' . $child->label : 'Tampilkan sub-menu ' . $child->label }}"
                                                            aria-label="{{ $child->is_active ? 'Sembunyikan sub-menu ' . $child->label : 'Tampilkan sub-menu ' . $child->label }}">
                                                            @if ($child->is_active)
                                                                <svg class="w-3.5 h-3.5" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.75"
                                                                    stroke="currentColor" aria-hidden="true">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                </svg>
                                                            @else
                                                                <svg class="w-3.5 h-3.5" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.75"
                                                                    stroke="currentColor" aria-hidden="true">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                                                </svg>
                                                            @endif
                                                        </button>
                                                    </form>

                                                    {{-- Tombol Hapus Sub-Menu --}}
                                                    <form action="{{ route('admin.menus.destroy', $child) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Hapus sub-menu {{ $child->label }}?')"
                                                        class="inline-flex">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="min-w-[32px] min-h-[32px] rounded-md text-[#BA1A1A] hover:bg-[#FEF2F2] inline-flex items-center justify-center transition-colors"
                                                            title="Hapus sub-menu {{ $child->label }}"
                                                            aria-label="Hapus sub-menu {{ $child->label }}">
                                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                                stroke-width="1.75" stroke="currentColor"
                                                                aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        </div>

        {{-- Modal Dialog Edit Menu & Sub-Menu (Level 4 Overlay) --}}
        <div x-show="editModalOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[#0F172A]/40 backdrop-blur-[4px]"
            role="dialog" aria-modal="true" aria-labelledby="modal-edit-menu-title" style="display: none;">

            <div @click.outside="editModalOpen = false"
                class="w-full max-w-lg rounded-lg bg-white border border-[#E2E8F0] shadow-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-[#E2E8F0] flex items-center justify-between">
                    <h2 id="modal-edit-menu-title" class="font-display text-base font-semibold text-[#0F172A]">
                        Sunting Menu Navigasi
                    </h2>
                    <button type="button" @click="editModalOpen = false"
                        class="min-w-[36px] min-h-[36px] flex items-center justify-center rounded-lg text-[#64748B] hover:text-[#0F172A] hover:bg-[#F1F5F9]"
                        aria-label="Tutup modal">
                        &times;
                    </button>
                </div>

                <form :action="editAction" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="edit_parent_id" class="block text-xs font-semibold text-[#0F172A] mb-1.5">
                            Posisi / Menu Induk
                        </label>
                        <select id="edit_parent_id" name="parent_id" x-model="editForm.parent_id"
                            :disabled="editForm.has_children"
                            class="w-full rounded-lg border border-[#CBD5E1] bg-white px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A] disabled:bg-[#F1F5F9] disabled:text-[#64748B]">
                            <option value="">-- Jadikan Menu Utama (Top Level) --</option>
                            @foreach ($parentOptions as $parent)
                                <option value="{{ $parent->id }}" x-show="editForm.id !== {{ $parent->id }}">
                                    Sub-menu dari: {{ $parent->label }}
                                </option>
                            @endforeach
                        </select>
                        <p x-show="editForm.has_children" class="mt-1 text-[11px] text-[#B45309]">
                            Menu ini memiliki sub-menu sehingga tetap berposisi sebagai Menu Utama.
                        </p>
                    </div>

                    <div>
                        <label for="edit_label" class="block text-xs font-semibold text-[#0F172A] mb-1.5">
                            Label Menu <span class="text-[#BA1A1A]">*</span>
                        </label>
                        <input type="text" id="edit_label" name="label" x-model="editForm.label" required
                            class="w-full rounded-lg border border-[#CBD5E1] px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A]">
                    </div>

                    <div>
                        <label for="edit_url" class="block text-xs font-semibold text-[#0F172A] mb-1.5">
                            URL Tujuan <span class="text-[#BA1A1A]">*</span>
                        </label>
                        <input type="text" id="edit_url" name="url" x-model="editForm.url" required
                            class="w-full rounded-lg border border-[#CBD5E1] px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A]">
                    </div>

                    <div>
                        <label for="edit_order" class="block text-xs font-semibold text-[#0F172A] mb-1.5">
                            Urutan Tampil
                        </label>
                        <input type="number" id="edit_order" name="order" x-model="editForm.order" min="0"
                            class="w-full rounded-lg border border-[#CBD5E1] px-3.5 py-2.5 text-sm text-[#0F172A] focus:border-[#0F172A]">
                    </div>

                    <div class="pt-1">
                        <label class="flex items-center gap-2.5 text-xs font-medium text-[#0F172A]">
                            <input type="checkbox" name="open_in_new_tab" value="1"
                                x-model="editForm.open_in_new_tab"
                                class="rounded border-[#CBD5E1] text-[#0F172A] focus:ring-[#0F172A]">
                            <span>Buka di tab baru</span>
                        </label>
                    </div>

                    <div class="pt-4 border-t border-[#F1F5F9] flex items-center justify-end gap-3">
                        <button type="button" @click="editModalOpen = false"
                            class="min-h-[40px] px-4 py-2 rounded-lg border border-[#CBD5E1] bg-white text-xs font-semibold text-[#0F172A] hover:bg-[#F1F5F9]">
                            Batal
                        </button>
                        <button type="submit"
                            class="min-h-[40px] px-5 py-2 rounded-lg bg-[#0F172A] text-white text-xs font-semibold hover:bg-[#1E293B]">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
