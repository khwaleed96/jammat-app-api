<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRoles = array('admin', 'city admin', 'Ammart Sectary', 'Halqa Sectary');

        foreach ($userRoles as $key => $value) {
            UserRole::create([
                'name' => $value,
            ]);
        }
    }
}
