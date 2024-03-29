<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Kehadiran;
use App\Models\Pertemuan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrudKehadiranTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function user_can_see_kehadiran_in_kehadiran_index_success(): void
    {
        Kelas::create([
            'name' => 'test',
        ]);
        $user = User::create([
            'name' => 'Mr. Toji Fusiguro',
            'username' => 'test',
            'alamat' => 'test',
            'password' => bcrypt('test'),
            'role_id' => 2,
        ]);
        Pertemuan::create([
            'kelas_id' => 1,
            'user_id' => 1,
            'tanggal' => '27/05/2026',
        ]);
        Kehadiran::create([
            'pertemuan_id' => 1,
            'user_id' => 1,
        ]);
        $this->actingAs($user);
        $this->visitRoute('kehadiran.index');
        $this->seeText('Mr. Toji Fusiguro');
        $this->seeText('27/05/2026');
    }
    /**
     * @test
     */
    public function user_can_input_new_kehadiran()
    {
        Kelas::create([
            'name' => 'test',
        ]);
        $user = User::create([
            'name' => 'Mr. Toji Fusiguro',
            'username' => 'test',
            'alamat' => 'test',
            'password' => bcrypt('test'),
            'role_id' => 2,
        ]);
        Pertemuan::create([
            'kelas_id' => 1,
            'user_id' => 1,
            'tanggal' => '27/05/2026',
        ]);
        $this->actingAs($user);
        $this->visitRoute('kehadiran.create');
        $this->submitForm('Submit', [
            'pertemuan_id' => 1,
            'user_id' => 1,
        ]);
        $this->seeRouteIs('kehadiran.index');
        $this->seeInDatabase('kehadirans', [
            'pertemuan_id' => 1,
            'user_id' => 1,
        ]);
    }
    /**
     * @test
     **/
    public function user_can_update_kehadiran()
    {
        Kelas::create([
            'name' => 'test',
        ]);
        $user = User::create([
            'name' => 'Mr. Toji Fusiguro',
            'username' => 'test',
            'alamat' => 'test',
            'password' => bcrypt('test'),
            'role_id' => 2,
        ]);
        Pertemuan::create([
            'kelas_id' => 1,
            'user_id' => 1,
            'tanggal' => '27/05/2026',
        ]);
        Pertemuan::create([
            'kelas_id' => 1,
            'user_id' => 1,
            'tanggal' => '27/05/2027',
        ]);
        $kehadiran = Kehadiran::create([
            'pertemuan_id' => 1,
            'user_id' => 1,
        ]);
        $this->actingAs($user);
        $this->visitRoute('kehadiran.update', $kehadiran);
        $this->submitForm('Submit', [
            'pertemuan_id' => 2,
            'user_id' => 1,
        ]);
        $this->seeRouteIs('kehadiran.index');
        $this->seeInDatabase('kehadirans', [
            'pertemuan_id' => 2,
            'user_id' => 1,
        ]);
    }
    /**
     * @test
     **/
    public function user_can_delete_kehadiran()
    {
        Kelas::create([
            'name' => 'test',
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
        $user = User::create([
            'name' => 'Mr. Toji Fusiguro',
            'username' => 'test',
            'alamat' => 'test',
            'password' => bcrypt('test'),
            'role_id' => 2,
        ]);
        User::create([
            'name' => 'Toji Simanjuntak',
            'username' => 'test',
            'alamat' => 'test',
            'password' => bcrypt('test'),
            'role_id' => 3,
        ]);
        Pertemuan::create([
            'kelas_id' => 1,
            'user_id' => 1,
            'tanggal' => '27/05/2026',
        ]);
        $kehadiran = Kehadiran::create([
            'pertemuan_id' => 1,
            'user_id' => 2,
        ]);
        $this->actingAs($user);
        $this->visitRoute('kehadiran.index');
        $this->seeText($kehadiran->user->name);
        $this->seeText($kehadiran->pertemuan->tanggal);
        $this->delete(route('pertemuan.destroy', $kehadiran->id));
        $this->dontSeeInDatabase('kehadirans', [
            'pertemuan_id' => 1,
            'user_id' => 2,
        ]);
    }
}
