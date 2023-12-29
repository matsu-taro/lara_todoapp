<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\File;


class Todo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'owner_name',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_name', 'name');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
