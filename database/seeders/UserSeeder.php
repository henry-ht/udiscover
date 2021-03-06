<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos = [
            array(
                'name'              => 'SuperAdmin',
                'email'             => 'admin@admin.com',
                'email_verified_at' => now(),
                'role'              => 'super_admin',
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
            ),
            array(
                'name'              => 'service',
                'email'             => 'service@admin.com',
                'email_verified_at' => now(),
                'role'              => 'app_service',
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
            ),
        ];

        foreach ($datos as $key => $value) {
            User::updateOrCreate([
                'email' => $value['email']
            ], $value);
        }
    }
}
