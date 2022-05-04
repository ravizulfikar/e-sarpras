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
            'name'              => 'Superadmin',
            'username'          => 'superadmin',
            'email'             => 'ravizulfikar17@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password'          => bcrypt(12345678900),
            'confirmed'         => true,
            'active'            => true,
            'profile'           => json_encode(["jabatan"=>"Superadmin", "photo"=>null], true),
            'role_id'           => 1,
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
    }
}
