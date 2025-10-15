<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrInsert([
                'name' => 'Admin',
        ],[
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('qwas-polk-00'),
        ]);
    }
}
