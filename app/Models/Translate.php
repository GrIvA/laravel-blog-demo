<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translate
 *
 * @property int $id
 * @property string $group
 * @property string $key
 * @property array $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Translate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Translate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translate whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translate whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translate whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
