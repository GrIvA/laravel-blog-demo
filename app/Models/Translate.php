<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
    use HasFactory;


    protected $table = 'language_lines';

    protected $attributes = [
        'text' => '{}',
    ];

    protected $casts = [
        'text' => 'array',
    ];

    protected $fillable = ['group', 'key', 'text'];
}
