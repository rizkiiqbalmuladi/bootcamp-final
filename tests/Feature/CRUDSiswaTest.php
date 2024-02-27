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
    /** @test */
    public function user_can_update_siswa()
    {
        Kelas::create([
            'name' => 'RPL 1',
        ]);
        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'guru'
        ]);

        $user = User::create([
            'name' => 'Admin',
            'username' => 'Rizki Iqbal',
            'alamat' => 'Caringin',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'kelas_id' => 1,
        ]);

        Kelas::create([
            'name' => 'RPL 1',
        ]);

        $this->actingAs($user);

        $this->visitRoute('user.edit', $user);
        $this->submitForm('Submit', [
            'name' => 'Admin Edited',
            'username' => 'Rizki Iqbal Edited',
            'alamat' => 'Caringin Edited',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'kelas_id' => 1,
        ]);
        $this->seeRouteIs('guru.index');
        $this->seeInDatabase('users', [
            'name' => 'Admin Edited',
            'username' => 'Rizki Iqbal Edited',
            'alamat' => 'Caringin Edited',
            'role_id' => 2,
            'kelas_id' => 1,
        ]);
    }
    /** @test  */
    public function user_can_delete_siswa()
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
            'username' => 'Rizki Iqbal',
            'alamat' => 'Caringin',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);

        $user2 = User::create([
            'name' => 'Rizki Iqbal Muladi',
            'username' => 'Rizki Iqbal Muladi',
            'alamat' => 'Caringin',
            'password' => bcrypt('password'),
            'role_id' => 3,
        ]);
        $this->actingAs($user);

        $this->visitRoute('siswa.index');
        $this->seeText($user2->name);
        // Hapus user2
        $this->delete(route('user.destroy', $user2->id));

        // Pastikan user2 sudah dihapus
        $this->visitRoute('guru.index');
        $this->dontSeeText($user2->name);
    }
}
