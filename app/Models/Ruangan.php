<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangans';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'kapasitas', 'gedung', 'lantai', 'foto_ruangan', 'foto_denah', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
