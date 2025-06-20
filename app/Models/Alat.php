<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alats';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'serial_number', 'desc', 'img', 'condition', 'status', 'location', 'detail_location', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'location', 'id');
    }
}
