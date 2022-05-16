<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('params')->insert([
            'name'          => 'Type Ticket',
            'slug'          => 'type-ticket',
            'object'        => json_encode(["troubleshooting", "server", "monitoring"], true),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
