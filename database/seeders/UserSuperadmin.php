<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSuperadmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'          => 'Superadmin',
            'username'      => 'superadmin',
            'email'         => 'ravizulfikar@gmail.com',
            'password'      => bcrypt(1234567890),
            'confirmed'     => true,
            'active'        => true,
            'profile'       => json_encode(["jabatan"=>"Superadmin", "photo"=>null], true),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
