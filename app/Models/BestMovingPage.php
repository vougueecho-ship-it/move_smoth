<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BestMovingPage extends Model {
    protected $fillable = ['title', 'slug', 'meta_title', 'meta_description', 'content', 'is_active'];
}
