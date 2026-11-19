<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Metrik Kartu Ringkasan (Card Overview)
        $totalStudents = 1084; // Dapat disesuaikan dengan Model Student jika tabel siswa sudah ada
        $totalStaff = User::count(); // Total pengguna/staf terdaftar
        $totalPublishedArticles = Article::where('status', 'published')->count();
        $pendingArticlesCount = Article::where('status', '!=', 'published')->count();
        $totalViews = Article::sum('views_count');

        // 2. Antrean Publikasi / Naskah Menunggu Kurasi (Editorial Queue)
        $pendingArticles = Article::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // 3. Dokumen / Unduhan Populer (bisa di-query dari log download atau artikel terkait)
        $popularArticles = Article::published()
            ->orderByDesc('views_count')
            ->take(3)
            ->get();

        return view('pages.admin.dashboard', compact(
            'totalStudents',
            'totalStaff',
            'totalPublishedArticles',
            'pendingArticlesCount',
            'pendingArticles',
            'totalViews',
            'popularArticles'
        ));
    }
}
