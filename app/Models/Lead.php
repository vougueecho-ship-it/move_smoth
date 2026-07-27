<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = ['company_id','quote_request_id','name','email','phone','message','zip_from','zip_to','move_date','move_size','status'];
    protected $casts = ['move_date' => 'date'];

    public function company() { return $this->belongsTo(Company::class); }
    public function quoteRequest() { return $this->belongsTo(QuoteRequest::class); }
}
