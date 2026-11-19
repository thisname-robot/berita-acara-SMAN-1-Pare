<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationMenu;
use Illuminate\Http\Request;

class NavigationMenuController extends Controller
{
    public function index()
    {
        $menus = NavigationMenu::orderBy('order')->orderBy('id')->get();
        return view('pages.admin.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
            'open_in_new_tab' => 'nullable|boolean',
        ], [
            'label.required' => 'Label menu wajib diisi (contoh: SIMS SMANSA).',
            'url.required' => 'URL tujuan wajib diisi.',
        ]);

        NavigationMenu::create([
            'label' => $validated['label'],
            'url' => $validated['url'],
            'order' => $validated['order'] ?? 0,
            'open_in_new_tab' => $request->has('open_in_new_tab'),
            'is_active' => true,
        ]);

        return redirect()->route('admin.menus.index')
            ->with('status', 'Menu navigasi baru berhasil ditambahkan ke portal.');
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
