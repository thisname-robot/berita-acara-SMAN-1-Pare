<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationMenu;
use Illuminate\Http\Request;

class NavigationMenuController extends Controller
{
    public function index()
    {
        // Ambil menu induk beserta sub-menunya untuk tabel hirarki
        $menus = NavigationMenu::whereNull('parent_id')
            ->with('children')
            ->orderBy('order')
            ->orderBy('id')
            ->get();

        // Daftar pilihan menu induk untuk dropdown di form
        $parentOptions = NavigationMenu::whereNull('parent_id')
            ->orderBy('order')
            ->get();

        return view('pages.admin.menus.index', compact('menus', 'parentOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:navigation_menus,id',
            'label' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
            'open_in_new_tab' => 'nullable|boolean',
        ], [
            'parent_id.exists' => 'Menu induk yang dipilih tidak valid.',
            'label.required' => 'Label menu wajib diisi.',
            'url.required' => 'URL tujuan wajib diisi.',
        ]);

        // Pastikan sub-menu tidak bertingkat lebih dari 1 level (mencegah sub-submenu)
        if (!empty($validated['parent_id'])) {
            $parent = NavigationMenu::find($validated['parent_id']);
            if ($parent && $parent->parent_id !== null) {
                return back()->withErrors(['parent_id' => 'Sub-menu hanya diperbolehkan 1 tingkat di bawah menu utama.']);
            }
        }

        NavigationMenu::create([
            'parent_id' => $validated['parent_id'] ?? null,
            'label' => $validated['label'],
            'url' => $validated['url'],
            'order' => $validated['order'] ?? 0,
            'open_in_new_tab' => $request->has('open_in_new_tab'),
            'is_active' => true,
        ]);

        return redirect()->route('admin.menus.index')
            ->with('status', 'Menu navigasi berhasil ditambahkan.');
    }

    public function update(Request $request, NavigationMenu $menu)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:navigation_menus,id',
            'label' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
            'open_in_new_tab' => 'nullable|boolean',
        ], [
            'parent_id.exists' => 'Menu induk yang dipilih tidak valid.',
            'label.required' => 'Label menu wajib diisi.',
            'url.required' => 'URL tujuan wajib diisi.',
        ]);

        $newParentId = $validated['parent_id'] ?? null;

        if (!empty($newParentId)) {
            // Mencegah menu memilih dirinya sendiri sebagai induk
            if ((int) $newParentId === (int) $menu->id) {
                return back()->withErrors(['parent_id' => 'Menu tidak dapat menjadi induk bagi dirinya sendiri.']);
            }

            // Mencegah menu utama yang sudah punya sub-menu diturunkan menjadi sub-menu
            if ($menu->children()->exists()) {
                return back()->withErrors(['parent_id' => 'Menu ini memiliki sub-menu. Hapus atau pindahkan sub-menunya terlebih dahulu sebelum menjadikannya sub-menu.']);
            }

            // Mencegah sub-menu bertingkat lebih dari 1 level
            $parent = NavigationMenu::find($newParentId);
            if ($parent && $parent->parent_id !== null) {
                return back()->withErrors(['parent_id' => 'Sub-menu hanya diperbolehkan 1 tingkat di bawah menu utama.']);
            }
        }

        $menu->update([
            'parent_id' => $newParentId,
            'label' => $validated['label'],
            'url' => $validated['url'],
            'order' => $validated['order'] ?? 0,
            'open_in_new_tab' => $request->has('open_in_new_tab'),
        ]);

        return redirect()->route('admin.menus.index')
            ->with('status', 'Perubahan pada menu "' . $menu->label . '" berhasil disimpan.');
    }

    public function toggleStatus(NavigationMenu $menu)
    {
        $menu->update([
            'is_active' => !$menu->is_active,
        ]);

        return redirect()->route('admin.menus.index')
            ->with('status', 'Status visibilitas menu berhasil diperbarui.');
    }

    public function destroy(NavigationMenu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menus.index')
            ->with('status', 'Menu navigasi berhasil dihapus.');
    }
}
