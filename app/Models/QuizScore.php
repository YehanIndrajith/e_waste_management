<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizScore extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'level', 'score', 'total_questions'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // ✅ Correct foreign key
    }
}
