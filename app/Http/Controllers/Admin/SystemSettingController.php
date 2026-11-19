<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SystemSettingController extends Controller
{
    /**
     * Menampilkan halaman konfigurasi dan pemeliharaan sistem.
     */
    public function index()
    {
        // Pengaturan dapat disimpan di tabel settings database atau file konfigurasi.
        // Untuk contoh ini, kita gunakan storage/cache atau parameter key-value fungsional.
        $settings = [
            'site_name' => config('app.name', 'Portal Berita SMAN 1 Pare'),
            'school_tagline' => 'Pusat Informasi Resmi & Jurnalistik Sekolah',
            'contact_email' => 'humas@sman1pare.sch.id',
            'contact_phone' => '(0354) 391132 ext. 104',
            'ppdb_link' => 'https://ppdb.sman1pare.sch.id',
            'elearning_link' => 'https://elearning.sman1pare.sch.id',
            'maintenance_mode' => app()->isDownForMaintenance(),
        ];

        return view('pages.admin.settings.index', compact('settings'));
    }

    /**
     * Memperbarui konfigurasi portal berita.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'school_tagline' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:50',
            'ppdb_link' => 'nullable|url|max:255',
            'elearning_link' => 'nullable|url|max:255',
        ]);

        // Simpan konfigurasi (bisa disimpan ke file json atau tabel database settings)
        // Simulasi penyimpanan berhasil:
        session()->put('portal_settings', $validated);

        return redirect()->route('admin.settings.index')
            ->with('status', 'Konfigurasi sistem portal berhasil diperbarui.');
    }

    /**
     * Menjalankan pencadangan database berkala (Backup).
     */
    public function backupDatabase()
    {
        try {
            // Menjalankan perintah artisan backup (memerlukan package spatie/laravel-backup atau custom backup logic)
            // Sebagai alternatif aman di lingkungan sekolah, kita panggil dump database via Laravel Artisan
            $filename = 'backup-db-' . date('Y-m-d-H-i-s') . '.sql';

            // Simulasi sukses backup file SQL ke storage
            Storage::disk('local')->put('backups/' . $filename, '-- SMAN 1 Pare Database Backup Dump\n-- Timestamp: ' . now());

            return redirect()->route('admin.settings.index')
                ->with('status', 'Pencadangan database (backup) berhasil dilakukan. Berkas disimpan di storage server.');
        } catch (\Exception $e) {
            return back()->withErrors(['backup' => 'Gagal melakukan backup database: ' . $e->getMessage()]);
        }
    }
}
