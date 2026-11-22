<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationMenu extends Model
{
    protected $fillable = [
        'parent_id',
        'label',
        'url',
        'open_in_new_tab',
        'order',
        'is_active',
    ];

    protected $casts = [
        'open_in_new_tab' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(NavigationMenu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(NavigationMenu::class, 'parent_id')
            ->orderBy('order')
            ->orderBy('id');
    }

    public function activeChildren()
    {
        return $this->hasMany(NavigationMenu::class, 'parent_id')
            ->where('is_active', true)
            ->orderBy('order')
            ->orderBy('id');
    }

    public function scopeRootActive($query)
    {
        return $query->whereNull('parent_id')
            ->where('is_active', true)
            ->with('activeChildren')
            ->orderBy('order')
            ->orderBy('id');
    }
}