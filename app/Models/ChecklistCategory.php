<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ChecklistCategory extends Model {
    protected $fillable = ['name', 'slug', 'description'];
    public function items() { return $this->hasMany(ChecklistItem::class); }
}
