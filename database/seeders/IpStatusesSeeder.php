<?php

namespace Database\Seeders;

use App\Models\TrackIp;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IpStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('ip_statuses')->insert([
            'id' => TrackIp::STATUS_WORKING,
            'name' => 'working',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('ip_statuses')->insert(
            ['id' => TrackIp::STATUS_APPROVED,
            'name' => 'aproved',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('ip_statuses')->insert([
            'id' => TrackIp::STATUS_BLOCKED,
            'name' => 'blocked',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
    ]);
    }
}
