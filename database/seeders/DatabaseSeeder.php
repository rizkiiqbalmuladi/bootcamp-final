<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Role;
use App\Models\Sekolah;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Sekolah::create([
            'name' => 'Sekolah Bootcamp',
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
        ]);
        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'guru',
        ]);
        Role::create([
            'name' => 'siswa',
        ]);
        User::create([
            'name' => fake()->name(),
            'username' => fake()->userName(),
            'alamat' => fake()->address(),
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);
        User::create([
            'name' => fake()->name(),
            'username' => fake()->userName(),
            'alamat' => fake()->address(),
            'password' => bcrypt('password'),
            'role_id' => 3,
        ]);
        Kelas::create([
            'name' => 'RPL 1',
        ]);

        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'iqbal',
            'username' => 'iqbal',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);
    }
}
