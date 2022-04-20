<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataLevel = [
            [
                "name"          => "superadmin",
            ],
            [
                "name"          => "admin",
            ],
            [
                "name"          => "user",
            ],
        ];

        foreach($dataLevel as $key => $val){
            \DB::table('levels')->insert([
                'level'          => $val["name"],
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
