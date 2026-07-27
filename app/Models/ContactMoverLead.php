<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ContactMoverLead extends Model {
    protected $fillable = ['company_id', 'name', 'email', 'phone', 'move_from', 'move_to', 'move_date', 'move_size', 'num_rooms', 'packing_service', 'storage_option', 'message'];
    public function company() { return $this->belongsTo(Company::class); }
}
