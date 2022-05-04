<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataRoles = [
            [
                "name"          => "Superadmin",
                "slug"          => "superadmin",
                "level"         => "superadmin",
                "description"   => "Superadmin Role",
                // "module"        => ["dashboard"],
            ],
            [
                "name"          => "Kepala Bidang Pusdatin PMPTSP",
                "slug"          => "kabid",
                "level"         => "admin",
                "description"   => "Kepala Bidang Pusdatin PMPTSP",
                // "module"        => ["dashboard"],
            ],
            [
                "name"          => "Kepala Sub Bagian Tata Usaha Pusdatin PMPTSP",
                "slug"          => "kasubbag",
                "level"         => "admin",
                "description"   => "Kepala Sub Bagian Tata Usaha Pusdatin PMPTSP",
                // "module"        => ["dashboard"],
            ],
            [
                "name"          => "Kepala Satuan Pelaksana SarpasTI Pusdatin PMPTSP",
                "slug"          => "kasatpel",
                "level"         => "admin",
                "description"   => "Kepala Satuan Pelaksana SarpasTI Pusdatin PMPTSP",
                // "module"        => ["dashboard"],
            ],
            [
                "name"          => "Staff PNS",
                "slug"          => "staff",
                "level"         => "admin",
                "description"   => "Staff PNS",
                // "module"        => ["dashboard"],
            ],
            [
                "name"          => "Tenaga Ahli Server dan Jaringan",
                "slug"          => "ta-admin",
                "level"         => "user",
                "description"   => "Tenaga Ahli Server dan Jaringan",
                // "module"        => ["dashboard"],
            ],
            [
                "name"          => "Tenaga Ahli Asisten Server dan Jaringan",
                "slug"          => "ta-asisten",
                "level"         => "user",
                "description"   => "Tenaga Ahli Asisten Server dan Jaringan",
                // "module"        => ["dashboard"],
            ],
            [
                "name"          => "Tenaga Ahli Teknisi Troubleshooting",
                "slug"          => "ta-teknisi",
                "level"         => "user",
                "description"   => "Tenaga Ahli Teknisi Troubleshooting",
                // "module"        => ["dashboard"],
            ],
        ];

        foreach($dataRoles as $key => $val){
            \DB::table('roles')->insert([
                'name'          => $val["name"],
                'slug'          => $val["slug"],
                'level'         => $val["level"],
                'description'   => $val["description"],
                // 'module'        => json_encode($val["module"], true),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }
        
    }
}
