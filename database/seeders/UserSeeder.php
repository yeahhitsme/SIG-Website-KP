<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        echo "Running UserSeeder...\n";

        User::create([
            'username' => 'dinkannak',
            'email' => 'dinkannak@gmail.com',
            'password' => Hash::make('2024kannak'),
            'name' => 'dinas',
        ]);
        echo "UserSeeder completed.\n";

}
}