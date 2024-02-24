<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\Sekolah;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrudSekolahTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function user_can_see_sekolah_in_sekolah_index_success(): void
    {
        Role::create([
            'name' => 'admin',
        ]);
        $user = User::create([
            'name' => 'test',
            'username' => 'test',
            'alamat' => 'test',
            'password' => bcrypt('test'),
            'role_id' => 1,
        ]);
        Sekolah::create([
            'name' => 'Sekolah Test',
            'address' => 'Address Test',
            'phone' => 'Phone Test',
        ]);


        $this->actingAs($user);
        $this->visitRoute('sekolah.index');
        $this->see('Sekolah Test');
        $this->see('Address Test');
        $this->see('Phone Test');
    }
    /**
     * @test
     */
    public function user_can_edit_kehadiran()
    {
        $sekolah = Sekolah::create([
            'name' => 'Sekolah Test',
            'address' => 'Address Test',
            'phone' => 'Phone Test',
        ]);
        $this->visit('sekolah/edit/' . $sekolah->id);
        $this->seeText('Edit Sekolah');
    }
}
