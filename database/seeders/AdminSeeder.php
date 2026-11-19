<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sman1pare.sch.id'],
            [
                'name'              => 'Administrator SMAN 1 Pare',
                'password'          => Hash::make('AdminSmansa2026!'),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
