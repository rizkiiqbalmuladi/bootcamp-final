<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CRUDSiswaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_see_siswa_in_siswa_index_success(): void
    {
        $user = User::create([
            'name' => 'Iqbal',
            'username' => 'Rizki Iqbal',
            'alamat' => 'Caringin',
            'password' => bcrypt('password'),
            'role_id' => 3,
        ]);

        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'guru'
        ]);
        Role::create([
            'name' => 'siswa'
        ]);

        $this->actingAs($user);
        $this->visitRoute('siswa.index');

        $this->seeText('Iqbal');
        $this->seeText('Caringin');
    }

    /**
     * @test
     **/
    public function user_can_input_new_siswa(): void
    {
        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'guru'
        ]);
        Role::create([
            'name' => 'siswa'
        ]);

        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'alamat' => 'lorem ipsum',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);

        Kelas::create([
            'name' => 'RPL 1',
        ]);

        $this->actingAs($user);

        $this->visitRoute('user.create');

        $this->submitForm('Submit', [
            'name' => 'Gojo',
            'username' => 'gojo',
            'alamat' => 'Cicadas',
            'password' => bcrypt('bandung'),
            'role_id' => 3,
            'kelas_id' => 1
        ]);

        $this->seeRouteIs('guru.index');

        $this->seeInDatabase('users', [
            'name' => 'Gojo',
            'username' => 'gojo',
            'alamat' => 'Cicadas',
            'role_id' => 3,
            'kelas_id' => 1
        ]);
    }
}
