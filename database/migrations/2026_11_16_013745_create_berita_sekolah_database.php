<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'editor', 'writer'])->default('writer');
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('color_code', 7)->default('#0055A5'); // Format Hex Warna
            $table->timestamps();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('thumbnail')->nullable();
            $table->enum('status', ['draft', 'pending', 'revision_needed', 'published'])->default('draft');
            $table->text('revision_note')->nullable(); // Catatan revisi dari Editor jika ditolak
            $table->boolean('is_headline')->default(false);
            $table->boolean('is_breaking')->default(false);
            $table->unsignedBigInteger('views_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            // Indexing untuk mempercepat query Headline, Breaking News, dan Terpopuler
            $table->index(['status', 'published_at']);
            $table->index(['is_headline', 'is_breaking']);
            $table->index('views_count');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('article_tag', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('tags')->cascadeOnDelete();

            $table->primary(['article_id', 'tag_id']);
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();
            $table->string('author_name');
            $table->text('content');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();

            $table->index(['article_id', 'is_approved']);
        });

        Schema::create('navigation_menus', function (Blueprint $table) {
            $table->id();
            $table->string('label'); // Contoh: "SIMS SMANSA", "PPDB", "Akademik"
            $table->string('url');   // Contoh: "https://sims.sman1pare.sch.id" atau "/kategori/prestasi"
            $table->boolean('open_in_new_tab')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('article_tag');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('navigation_menus');
    }
};
