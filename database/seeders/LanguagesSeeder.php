<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('languages')->insert([
            'id'         => 1,
            'name'       => 'English',
            'abr'        => 'en',
            'locale'     => 'English',
            'available'  => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('languages')->insert([
            'id'         => 2,
            'name'       => 'Ukrainian',
            'abr'        => 'uk',
            'locale'     => 'Українська',
            'available'  => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('languages')->insert([
            'id'         => 3,
            'name'       => 'Russian',
            'abr'        => 'ru',
            'locale'     => 'Русский',
            'available'  => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('languages')->insert([
            'id'         => 4,
            'name'       => 'Spanish',
            'abr'        => 'es',
            'locale'     => 'Español',
            'available'  => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('languages')->insert([
            'id'         => 5,
            'name'       => 'German',
            'abr'        => 'de',
            'locale'     => 'Deutsch',
            'available'  => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('languages')->insert([
            'id'         => 6,
            'name'       => 'French',
            'abr'        => 'fr',
            'locale'     => 'Français',
            'available'  => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('languages')->insert([
            'id'         => 7,
            'name'       => 'Portuguese',
            'abr'        => 'pt',
            'locale'     => 'Português',
            'available'  => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('languages')->insert([
            'id'         => 1000,
            'name'       => 'Vars',
            'abr'        => 'ur',
            'locale'     => 'Vars',
            'available'  => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
