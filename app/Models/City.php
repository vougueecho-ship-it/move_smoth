<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'state_id', 'name', 'zip_code', 'latitude', 'longitude'
    ];

    public function state() { return $this->belongsTo(State::class); }
    
    public function content()
    {
        return $this->hasOne(CityContent::class, 'city_id');
    }

    public function faqs()
    {
        return $this->hasMany(CityFaq::class, 'city_id');
    }

    public function scopeActive($query)
    {
        return $query->whereHas('content', function($q) {
            $q->where('is_active', true)->whereNotNull('content');
        });
    }
}
