<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Service extends Model
{
use HasFactory;
protected $fillable = ['service_category_id','name','slug','description'];
public function category()
{
return $this->belongsTo(ServiceCategory::class, 'service_category_id');
} public function plumbers()
{
return $this->belongsToMany(Plumber::class, 'plumber_service');
}
}
