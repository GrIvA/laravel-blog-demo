<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SiteLog
 *
 * @property int $id
 * @property string $level
 * @property string|null $message
 * @property string|null $user_id
 * @property string $channel
 * @property string|null $remote_addr
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SiteLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteLog whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteLog whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteLog whereRemoteAddr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteLog whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteLog whereUserId($value)
 * @mixin \Eloquent
 */
class SiteLog extends Model
{
    use HasFactory;

    protected $fillable = ['level', 'message', 'user_id', 'channel', 'remote_addr'];

    protected $table = 'logs';


}

