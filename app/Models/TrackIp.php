<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TrackIp
 *
 * @property int $id
 * @property string|null $remote_addr
 * @property int|null $ip_status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\IpStatus|null $statusname
 * @method static \Illuminate\Database\Eloquent\Builder|TrackIp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackIp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackIp query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackIp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackIp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackIp whereIpStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackIp whereRemoteAddr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackIp whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TrackIp extends Model
{
    use HasFactory;

    protected $fillable = ['remote_addr', 'ip_status_id'];

    const STATUS_WORKING  = 1;
    const STATUS_APPROVED = 2;
    const STATUS_BLOCKED  = 3;

    protected $table = 'track_ips';


    public function statusname()
    {
        return $this->belongsTo(IpStatus::class, 'ip_status_id');
    }

}
