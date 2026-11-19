<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Tim Jurnalistik SMANSA',
            'email' => 'humas@sman1pare.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $catPrestasi = Category::create([
            'name' => 'Prestasi',
            'slug' => 'prestasi',
            'color_code' => '#0055A5',
        ]);

        $catKegiatan = Category::create([
            'name' => 'Kegiatan Sekolah',
            'slug' => 'kegiatan',
            'color_code' => '#0D9488',
        ]);

        $catPengumuman = Category::create([
            'name' => 'Pengumuman',
            'slug' => 'pengumuman',
            'color_code' => '#DC2626',
        ]);

        $tagOsn = Tag::create(['name' => 'OSN 2025', 'slug' => 'osn-2025']);

        $headline = Article::create([
            'user_id' => $admin->id,
            'category_id' => $catPrestasi->id,
            'title' => 'Tim Olimpiade Sains SMAN 1 Pare Raih 3 Medali Emas di Ajang OSN Nasional 2025',
            'slug' => Str::slug('Tim Olimpiade Sains SMAN 1 Pare Raih 3 Medali Emas di Ajang OSN Nasional 2025'),
            'content' => '<p>Prestasi gemilang kembali ditorehkan delegasi sains SMA Negeri 1 Pare pada ajang Olimpiade Sains Nasional (OSN) tingkat nasional di Bandung. Tiga siswa sukses menyabet medali emas di bidang Fisika Terapan, Kebumian, dan Biologi Molekuler setelah melalui seleksi ketat selama 5 hari berturut-turut.</p>',
            'status' => 'published',
            'is_headline' => true,
            'is_breaking' => false,
            'views_count' => 1450,
            'published_at' => now()->subDay(),
        ]);
        $headline->tags()->attach($tagOsn->id);

        Article::create([
            'user_id' => $admin->id,
            'category_id' => $catKegiatan->id,
            'title' => 'Peringatan Bulan Bahasa dan Gelar Budaya Nusantara SMAN 1 Pare 2025',
            'slug' => Str::slug('Peringatan Bulan Bahasa dan Gelar Budaya Nusantara SMAN 1 Pare 2025'),
            'content' => '<p>Seluruh kelas X hingga XII menampilkan kekayaan seni sastra, orasi kebangsaan, dan karnaval busana adat daerah dalam rangka memperkokoh karakter kebhinekaan pelajar.</p>',
            'status' => 'published',
            'is_headline' => false,
            'is_breaking' => false,
            'views_count' => 820,
            'published_at' => now()->subDays(2),
        ]);

        Article::create([
            'user_id' => $admin->id,
            'category_id' => $catPengumuman->id,
            'title' => 'Verifikasi Nilai Rapor PDSS untuk Seleksi SNBP 2026',
            'slug' => Str::slug('Verifikasi Nilai Rapor PDSS untuk Seleksi SNBP 2026'),
            'content' => '<p>Siswa kelas XII jalur eligible wajib mencocokkan data rapor fisik dengan sistem database sekolah sebelum batas akhir verifikasi.</p>',
            'status' => 'published',
            'is_headline' => false,
            'is_breaking' => true,
            'views_count' => 2100,
            'published_at' => now(),
        ]);
    }
}
