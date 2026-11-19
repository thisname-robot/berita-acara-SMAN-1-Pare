<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori dan tag berita.
     */
    public function index()
    {
        $categories = Category::withCount('articles')->latest()->get();
        $tags = Tag::withCount('articles')->latest()->get();

        return view('pages.admin.categories.index', compact('categories', 'tags'));
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'color_code' => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori ini sudah terdaftar.',
            'color_code.required' => 'Kode warna label wajib dipilih.',
            'color_code.regex' => 'Format kode warna harus berupa Hexadesimal yang valid (contoh: #0055A5).',
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'color_code' => $validated['color_code'],
        ]);

        return redirect()->route('admin.categories.index')
            ->with('status', 'Kategori berita baru berhasil ditambahkan.');
    }

    /**
     * Menyimpan tag baru ke database.
     */
    public function storeTag(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ], [
            'name.required' => 'Nama tag wajib diisi.',
            'name.unique' => 'Tag ini sudah terdaftar.',
        ]);

        Tag::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('status', 'Tagar (Tag) baru berhasil ditambahkan.');
    }

    /**
     * Menghapus kategori berita.
     */
    public function destroyCategory(Category $category)
    {
        // Pastikan tidak menghapus kategori yang masih memiliki relasi artikel aktif (sesuai restrictOnDelete)
        if ($category->articles()->count() > 0) {
            return back()->withErrors(['category' => 'Kategori tidak dapat dihapus karena masih digunakan oleh artikel aktif.']);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('status', 'Kategori berhasil dihapus dari sistem.');
    }

    /**
     * Menghapus tag berita.
     */
    public function destroyTag(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.categories.index')
            ->with('status', 'Tagar berhasil dihapus dari sistem.');
    }
}
