<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'gbce',
            'last_name' => 'gbce',
            'phone' => '0713074067',
            'user_type' => '1',
            'email' => 'gbceadmin@gmail.com.',
            'password' => bcrypt('@gbceadmin2024'),
        ]);
    }
    //run the seeder to populate system admin
    // php artisan db:seed --class=user_seeder
}
