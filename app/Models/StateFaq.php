<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateFaq extends Model
{
    protected $table = 'state_faqs';
    
    protected $fillable = ['state_id', 'question', 'answer', 'order'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
