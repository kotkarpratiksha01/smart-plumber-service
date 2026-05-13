<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Booking extends Model
{
use HasFactory;
protected $fillable = ['plumber_id','user_name','user_phone','service','scheduled_at','notes','status']; 
protected $casts = [ 
'scheduled_at' => 'datetime',
];
public function plumber()
{
return $this->belongsTo(Plumber::class);
}
}
