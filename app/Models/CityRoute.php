<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CityRoute extends Model {
    protected $fillable = [
        'from_city_id', 'to_city_id', 'title', 'slug', 'min_cost', 'max_cost', 
        'miles', 'content', 'meta_title', 'meta_description', 'meta_keywords'
    ];
    public function fromCity() { return $this->belongsTo(City::class, 'from_city_id'); }
    public function toCity() { return $this->belongsTo(City::class, 'to_city_id'); }
}
