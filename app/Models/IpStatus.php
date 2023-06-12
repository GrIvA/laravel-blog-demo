<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\IpStatus
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|IpStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|IpStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IpStatus extends Model
{
    use HasFactory;

    protected $table = 'ip_statuses';


}
