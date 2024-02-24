<?php

namespace Tests\Feature;

use App\Models\Kelas;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\Pertemuan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrudPertemuanTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function user_can_see_pertemuan_in_pertemuan_index_success(): void
    {
        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'guru',
        ]);
        Kelas::create([
            'name' => 'X RPL',
        ]);
        $user = User::create([
            'name' => 'Gojo Setiawan',
            'username' => 'test',
            'alamat' => 'test',
            'password' => bcrypt('test'),
            'role_id' => 2,
        ]);
        Pertemuan::create([
            'kelas_id' => 1,
            'user_id' => 1,
            'tanggal' => '25/07/2024',
        ]);
        $this->actingAs($user);
        $this->visitRoute('pertemuan.index');
        $this->seeText('Gojo Setiawan');
        $this->seeText('25/07/2024');
        $this->seeText('X RPL');
    }
    /**
     * @test
     **/
    public function user_can_input_new_pertemuan()
    {
        Kelas::create([
            'name' => 'X RPL',
        ]);
        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'guru',
        ]);
        $user = User::create([
            'name' => 'Gojo Setiawan',
            'username' => 'test',
            'alamat' => 'test',
            'password' => bcrypt('test'),
            'role_id' => 2,
        ]);
        $this->actingAs($user);
        $this->visitRoute('pertemuan.create');
        $this->submitForm('Submit', [
            'tanggal' => '25/07/2024',
            'kelas_id' => 1,
            'user_id' => 1,
        ]);
        $this->seeRouteIs('pertemuan.index');
        $this->seeInDatabase('pertemuans', [
            'tanggal' => '25/07/2024',
            'kelas_id' => 1,
            'user_id' => 1
        ]);
    }
    /**
     * @test
     **/
    public function user_can_edit_pertemuan()
    {
        Kelas::create([
            'name' => 'X RPL',
        ]);
        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'guru',
        ]);
        $user = User::create([
            'name' => 'Gojo Setiawan',
            'username' => 'test',
            'alamat' => 'test',
            'password' => bcrypt('test'),
            'role_id' => 2,
        ]);
        $pertemuan = Pertemuan::create([
            'tanggal' => '25/07/2024',
            'kelas_id' => 1,
            'user_id' => 1,
        ]);
        $this->actingAs($user);
        $this->visitRoute('pertemuan.edit', $pertemuan);
        $this->submitForm('Submit', [
            'tanggal' => '25/07/2025',
            'kelas_id' => 1,
            'user_id' => 1,
        ]);
        $this->seeRouteIs('pertemuan.index');
        $this->seeInDatabase('pertemuans', [
            'tanggal' => '25/07/2025',
            'kelas_id' => 1,
            'user_id' => 1
        ]);
    }
    /**
     * @test
     **/
    public function user_can_delete_pertemuan()
    {
        Kelas::create([
            'name' => 'X RPL',
        ]);
        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'guru',
        ]);
        $user = User::create([
            'name' => 'Gojo Setiawan',
            'username' => 'test',
            'alamat' => 'test',
            'password' => bcrypt('test'),
            'role_id' => 2,
        ]);
        $pertemuan = Pertemuan::create([
            'tanggal' => '25/07/2024',
            'kelas_id' => 1,
            'user_id' => 1,
        ]);
        $this->actingAs($user);
        $this->visitRoute('pertemuan.index');
        $this->seeText('25/07/2024');
        // Hapus user2
        $this->delete(route('pertemuan.destroy', $pertemuan->id));
        // // Pastikan user2 sudah dihapus
        $this->visitRoute('pertemuan.index');
        $this->dontSeeInDatabase('pertemuans', [
            'tanggal' => '25/07/2024',
            'kelas_id' => 1,
            'user_id' => 1,
        ]);
    }
}
