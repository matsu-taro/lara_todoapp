<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Todo;

class file extends Model
{
    use HasFactory;

    protected $fillable = [
        'todo_id',
        'original_file_name',
        'path',
    ];

    public function todo(){
        return $this->belongsTo(Todo::class);
    }
}
