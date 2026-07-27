<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityContent extends Model
{
    protected $table = 'city_contents';
    
    protected $fillable = [
        'city_id', 'slug', 'meta_title', 'meta_description', 'heading', 'content', 'content_below', 'is_active'
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
