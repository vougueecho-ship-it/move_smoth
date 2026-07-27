<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TopMover extends Model {
    protected $fillable = ['company_id', 'order', 'badge', 'heading_1', 'heading_2', 'heading_3'];

    public function company() { return $this->belongsTo(Company::class); }

    public function states() { return $this->belongsToMany(State::class, 'top_mover_state'); }
    
    public function cities() { return $this->belongsToMany(City::class, 'top_mover_city'); }
}
