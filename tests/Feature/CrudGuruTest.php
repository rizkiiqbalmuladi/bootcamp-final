<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CrudGuruTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function user_can_see_guru_in_guru_index_success(): void
    {
        $user = User::create([
            'name' => 'Iqbal',
            'username' => 'Rizki Iqbal',
            'alamat' => 'Caringin',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'guru'
        ]);

        $this->actingAs($user);
        $this->visitRoute('guru.index');

        $this->seeText('Iqbal');
        $this->seeText('Caringin');
    }

    /**
     * @test
     */
    public function user_can_input_new_guru(): void
    {
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
        ]);

        Kelas::create([
            'name' => 'RPL 1',
        ]);

        $this->actingAs($user);

        $this->visitRoute('user.create');

        $this->submitForm('Submit', [
            'name' => 'Iqbal',
            'username' => 'iqbal',
            'alamat' => 'Caringin',
            'password' => bcrypt('bandung'),
            'role_id' => 2,
            'kelas_id' => 1
        ]);

        $this->seeRouteIs('guru.index');

        $this->seeInDatabase('users', [
            'name' => 'Iqbal',
            'username' => 'iqbal',
            'alamat' => 'Caringin',
            'role_id' => 2,
            'kelas_id' => 1
        ]);
    }

    /** @test */
    public function user_can_update_guru()
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
            'kelas_id' => 1
        ]);
        $this->seeRouteIs('guru.index');
        $this->seeInDatabase('users', [
            'name' => 'Admin Edited',
            'username' => 'Rizki Iqbal Edited',
            'alamat' => 'Caringin Edited',
            'role_id' => 2,
            'kelas_id' => 1
        ]);
    }
    /** @test  */
    public function user_can_delete_guru()
    {
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
        ]);

        $user2 = User::create([
            'name' => 'Rizki Iqbal Muladi',
            'username' => 'Rizki Iqbal Muladi',
            'alamat' => 'Caringin',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);
        $this->actingAs($user);

        $this->visitRoute('guru.index');
        $this->seeText($user2->name);
        // Hapus user2
        $this->delete(route('user.destroy', $user2->id));

        // Pastikan user2 sudah dihapus
        $this->visitRoute('guru.index');
        $this->dontSeeText($user2->name);
    }
}
