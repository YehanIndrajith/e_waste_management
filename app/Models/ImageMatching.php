<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ImageMatching extends Model
{
    use HasFactory;

    protected $table = 'image_matching';

    protected $fillable = [
        'image',
        'category',
    ];
}
