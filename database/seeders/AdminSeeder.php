<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => '123456789',
            'role' => 'admin',
            'fakultas' => 'Teknik',
            'jurusan' => 'Informatika',
            'nra' => '123456789',
        ]);

        $this->command->info('Admin users berhasil ditambahkan.');
    }
}
