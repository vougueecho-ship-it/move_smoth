<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ChecklistItem extends Model {
    protected $fillable = ['checklist_category_id', 'title', 'content', 'order'];
    public function category() { return $this->belongsTo(ChecklistCategory::class, 'checklist_category_id'); }
}
