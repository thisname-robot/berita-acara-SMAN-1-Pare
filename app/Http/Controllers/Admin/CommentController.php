<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Menampilkan daftar komentar pembaca untuk dimoderasi oleh admin/editor.
     */
    public function index(Request $request)
    {
        $query = Comment::with('article')->latest();

        // Filter berdasarkan status moderasi
        if ($request->filled('status')) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_approved', false);
            }
        }

        $comments = $query->paginate(10)->withQueryString();

        return view('pages.admin.comments.index', compact('comments'));
    }

    /**
     * Menyetujui atau membatalkan persetujuan komentar (Toggle Moderasi).
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'is_approved' => ! $comment->is_approved,
        ]);

        $statusLabel = $comment->is_approved ? 'disetujui dan kini tampil di publik' : 'disembunyikan (pending)';

        return redirect()->route('admin.comments.index')
            ->with('status', 'Komentar berhasil '.$statusLabel.'.');
    }

    /**
     * Menghapus komentar pembaca.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')
            ->with('status', 'Komentar berhasil dihapus dari sistem.');
    }
}
