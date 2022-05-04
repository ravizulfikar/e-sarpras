<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('theme_user')->insert([
            'user_id'       => 1,
            'class'         => 'dark-only',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
