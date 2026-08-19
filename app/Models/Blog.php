<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title','slug','meta_title','meta_keywords','meta_description','featured_image','category_id','user_id','content','status','published_at'];

    protected $casts = ['published_at' => 'datetime'];

    public function category() { return $this->belongsTo(BlogCategory::class, 'category_id'); }
    public function user() { return $this->belongsTo(User::class); }
    public function faqs() { return $this->hasMany(BlogFaq::class); }

    public function getFeaturedImageUrlAttribute(): string
    {
        if ($this->featured_image && file_exists(public_path('storage/' . $this->featured_image))) {
            return asset('storage/' . $this->featured_image);
        }
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        return asset('images/house-property.jpg');
    }
}
