<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
