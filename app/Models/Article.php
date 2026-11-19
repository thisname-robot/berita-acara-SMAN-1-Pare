<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'thumbnail',
        'status',
        'revision_note',
        'is_headline',
        'is_breaking',
        'views_count',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_headline' => 'boolean',
            'is_breaking' => 'boolean',
            'views_count' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    // Relasi
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('is_approved', true);
    }

    // Query Scopes
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeHeadline(Builder $query): Builder
    {
        return $query->where('is_headline', true);
    }

    public function scopeBreaking(Builder $query): Builder
    {
        return $query->where('is_breaking', true);
    }

    // Accessor bantuan untuk ringkasan & estimasi waktu baca
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->content), 180);
    }

    public function getReadTimeAttribute(): string
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = max(1, (int) ceil($words / 200));
        return "{$minutes} Menit Baca";
    }

    public function getThumbnailUrlAttribute(): string
    {
        if (!$this->thumbnail) {
            return 'https://placehold.co/800x500/e2e8f0/1e293b?text=SMAN+1+Pare';
        }

        return Str::startsWith($this->thumbnail, ['http://', 'https://'])
            ? $this->thumbnail
            : asset('storage/' . $this->thumbnail);
    }
}
