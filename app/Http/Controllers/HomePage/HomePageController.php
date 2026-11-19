<?php

namespace App\Http\Controllers\HomePage;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function home(Request $request)
    {
        // 1. Ambil 1 artikel Headline Utama (Sorotan Utama Humas)
        $headlineArticle = Article::with(['user', 'category'])
            ->published()
            ->headline()
            ->latest('published_at')
            ->first();

        // Fallback jika belum ada yang ditandai is_headline = true
        if (! $headlineArticle) {
            $headlineArticle = Article::with(['user', 'category'])
                ->published()
                ->latest('published_at')
                ->first();
        }

        // 2. Query daftar artikel (kecualikan headline utama agar tidak duplikat jika tidak sedang filter)
        $articlesQuery = Article::with(['user', 'category'])
            ->published()
            ->when(
                $headlineArticle && ! $request->filled('q') && (! $request->filled('kategori') || $request->kategori === 'all'),
                fn ($q) => $q->where('id', '!=', $headlineArticle->id)
            )
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->q;
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('kategori') && $request->kategori !== 'all', function ($query) use ($request) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $request->kategori));
            });

        // Pengurutan
        match ($request->get('sort', 'latest')) {
            'popular' => $articlesQuery->orderByDesc('views_count'),
            'oldest' => $articlesQuery->oldest('published_at'),
            default => $articlesQuery->latest('published_at'),
        };

        $articles = $articlesQuery->paginate(6)->withQueryString();

        // 3. Ambil daftar kategori beserta jumlah artikel published untuk Tab Filter
        $categories = Category::withCount([
            'articles' => fn ($q) => $q->published(),
        ])->get();

        $totalPublished = Article::published()->count();

        // 4. Breaking News / Pengumuman Penting di Sidebar
        $breakingNews = Article::with('category')
            ->published()
            ->breaking()
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.berita-artikel', [
            'activeMenu' => 'berita-artikel',
            'headlineArticle' => $headlineArticle,
            'articles' => $articles,
            'categories' => $categories,
            'totalPublished' => $totalPublished,
            'breakingNews' => $breakingNews,
        ]);
    }

    public function detailBerita($slug)
    {
        $article = Article::with(['user', 'category', 'tags', 'approvedComments'])
            ->published()
            ->where('slug', $slug)
            ->orWhere('id', $slug)
            ->firstOrFail();

        // Tambah jumlah pembaca
        $article->increment('views_count');

        // Artikel terkait dalam kategori yang sama
        $relatedArticles = Article::with(['user', 'category'])
            ->published()
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.detail-berita', compact('article', 'relatedArticles'));
    }

    public function storeComment(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)
            ->orWhere('id', $slug)
            ->firstOrFail();

        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ], [
            'author_name.required' => 'Nama pengirim / identitas wajib diisi.',
            'content.required' => 'Isi komentar tidak boleh kosong.',
        ]);

        // Simpan komentar dengan status is_approved = false (menunggu moderasi admin)
        $article->comments()->create([
            'author_name' => $validated['author_name'],
            'content' => $validated['content'],
            'is_approved' => false,
        ]);

        return back()->with('status', 'Komentar berhasil dikirim! Komentar Anda akan ditampilkan setelah melalui moderasi oleh tim redaksi.');
    }
}
