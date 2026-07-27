<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name','slug','icon','short_description','content','meta_title','meta_description','featured_image','sort_order','is_active'];
    protected $casts = ['is_active' => 'boolean'];
}
