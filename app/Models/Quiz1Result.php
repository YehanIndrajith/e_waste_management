<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz1Result extends Model
{
    use HasFactory;

    protected $table = 'quiz_1_results'; 

    protected $fillable = [
        'username',
        'level',
        'marks',
    ];

}
