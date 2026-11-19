<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Menampilkan daftar seluruh artikel untuk dikelola redaksi.
     */
    public function index(Request $request)
    {
        $query = Article::with(['user', 'category', 'tags'])->latest();

        // Filter berdasarkan pencarian judul
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $articles = $query->paginate(10)->withQueryString();

        return view('pages.admin.articles.index', compact('articles'));
    }

    /**
     * Menampilkan formulir pembuatan artikel baru.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('pages.admin.articles.create', compact('categories', 'tags'));
    }

    /**
     * Menyimpan artikel baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:draft,pending,published',
            'is_headline' => 'nullable|boolean',
            'is_breaking' => 'nullable|boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('articles/thumbnails', 'public');
        }

        $article = Article::create([
            'user_id' => auth()->id(),
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
            'content' => $validated['content'],
            'thumbnail' => $thumbnailPath,
            'status' => $validated['status'],
            'is_headline' => $request->has('is_headline'),
            'is_breaking' => $request->has('is_breaking'),
            'published_at' => $validated['status'] === 'published' ? now() : null,
        ]);

        if (!empty($validated['tags'])) {
            $article->tags()->sync($validated['tags']);
        }

        return redirect()->route('admin.articles.index')
            ->with('status', 'Artikel berita berhasil disimpan.');
    }

    /**
     * Menampilkan formulir penyuntingan artikel.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $selectedTags = $article->tags->pluck('id')->toArray();

        return view('pages.admin.articles.edit', compact('article', 'categories', 'tags', 'selectedTags'));
    }

    /**
     * Memperbarui artikel di database.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:draft,pending,revision_needed,published',
            'revision_note' => 'nullable|string',
            'is_headline' => 'nullable|boolean',
            'is_breaking' => 'nullable|boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $article->thumbnail = $request->file('thumbnail')->store('articles/thumbnails', 'public');
        }

        $wasPublished = $article->status === 'published';
        $isNowPublished = $validated['status'] === 'published';

        $article->update([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'content' => $validated['content'],
            'status' => $validated['status'],
            'revision_note' => $validated['status'] === 'revision_needed' ? $validated['revision_note'] : null,
            'is_headline' => $request->has('is_headline'),
            'is_breaking' => $request->has('is_breaking'),
            'published_at' => (!$wasPublished && $isNowPublished) ? now() : $article->published_at,
        ]);

        $article->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.articles.index')
            ->with('status', 'Artikel berita berhasil diperbarui.');
    }

    /**
     * Menghapus artikel.
     */
    public function destroy(Article $article)
    {
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->tags()->detach();
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('status', 'Artikel berita berhasil dihapus.');
    }
}
