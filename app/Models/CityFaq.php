<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityFaq extends Model
{
    protected $table = 'city_faqs';
    
    protected $fillable = ['city_id', 'question', 'answer', 'order'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
