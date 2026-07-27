<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'company_id', 'user_id', 'name', 'email', 'phone', 'title', 
        'rating', 'review', 'comment', 'move_type', 'move_date', 'would_recommend', 'status',
        'move_size', 'pickup_state_id', 'pickup_city', 'delivery_state_id', 'delivery_city', 'image1', 'image2', 'image3'
    ];

    public function getCommentAttribute()
    {
        return $this->attributes['review'] ?? '';
    }

    public function setCommentAttribute($value)
    {
        $this->attributes['review'] = $value;
    }

    public function company() { return $this->belongsTo(Company::class); }
    public function user() { return $this->belongsTo(User::class); }
}
