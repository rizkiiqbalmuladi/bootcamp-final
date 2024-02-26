<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Sarpras;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrudSarprasTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function user_can_see_sarpras_in_sarpras_index(): void
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

        Sarpras::create([
            'name' => 'Meja',
            'quantity' => 40,
            'ruangan' => '1 A'
        ]);

        $this->actingAs($user);
        $this->visitRoute('sarpras.index');

        $this->seeText('Meja');
        $this->seeText('40');
        $this->seeText('1 A');
    }
}
