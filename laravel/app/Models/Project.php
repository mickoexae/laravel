<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    // 🔹 Relasi ke User (Many to One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔹 Relasi ke Task (One to Many)
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
