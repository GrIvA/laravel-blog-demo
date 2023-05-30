<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteLog extends Model
{
    use HasFactory;

    protected $fillable = ['level', 'message', 'user_id', 'channel', 'remote_addr'];

    protected $table = 'logs';


}

