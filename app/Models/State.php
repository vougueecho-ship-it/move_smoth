<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class State extends Model
{
    protected $fillable = ['country_id', 'name', 'code', 'slug', 'meta_title', 'meta_description', 'heading', 'content', 'content_below', 'is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->whereNotNull('content');
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($state) {
            if (empty($state->slug)) $state->slug = \Illuminate\Support\Str::slug($state->name);
        });
    }

    public function country() { return $this->belongsTo(Country::class); }
    public function cities() { return $this->hasMany(City::class); }
    public function companies() { return $this->hasMany(Company::class); }
    public function faqs() { return $this->hasMany(StateFaq::class)->orderBy('order'); }
}
