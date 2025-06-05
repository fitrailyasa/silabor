<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $table = 'bahans';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'desc', 'img', 'unit', 'stock', 'min_stock', 'date_received', 'date_expired', 'status', 'location', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
