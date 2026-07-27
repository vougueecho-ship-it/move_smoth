<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BottomMover extends Model {
    protected $fillable = ['company_id', 'order', 'content'];

    public function company() { return $this->belongsTo(Company::class); }

    public function states() { return $this->belongsToMany(State::class, 'bottom_mover_state'); }
    
    public function cities() { return $this->belongsToMany(City::class, 'bottom_mover_city'); }
}
