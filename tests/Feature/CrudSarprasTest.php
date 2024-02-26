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
    /**
     * @test
     */
    public function user_can_input_new_sarpras(): void
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
        $this->visitRoute('sarpras.create');
        $this->submitForm('Submit', [
            'name' => 'Meja',
            'quantity' => 40,
            'ruangan' => '1 A'
        ]);

        $this->seeInDatabase('sarpras', [
            'name' => 'Meja',
            'quantity' => 40,
            'ruangan' => '1 A'
        ]);
    }
    /**
     * @test
     */
    public function user_can_update_sarpras(): void
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

        $sarpras = Sarpras::create([
            'name' => 'Meja',
            'quantity' => 40,
            'ruangan' => '1 A'
        ]);
        $this->actingAs($user);
        $this->visitRoute('sarpras.edit', $sarpras);
        $this->submitForm('Submit', [
            'name' => 'Meja Edited',
            'quantity' => 50,
            'ruangan' => '2 A'
        ]);
        $this->seeRouteIs('sarpras.index');
        $this->seeInDatabase('sarpras', [
            'name' => 'Meja Edited',
            'quantity' => 50,
            'ruangan' => '2 A'
        ]);
    }
    /**
     * @test
     */
    public function user_can_delete_sarpras(): void
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

        $sarpras = Sarpras::create([
            'name' => 'Meja',
            'quantity' => 40,
            'ruangan' => '1 A'
        ]);
        $this->actingAs($user);
        $this->visitRoute('sarpras.index');
        $this->seeText('Meja');
        $this->seeText('40');
        $this->seeText('1 A');
        $this->delete(route('sarpras.destroy', $sarpras));
        $this->visitRoute('sarpras.index');
        $this->dontSeeText('Meja');
        $this->dontSeeText('40');
        $this->dontSeeText('1 A');
        $this->dontSeeInDatabase('sarpras', [
            'name' => 'Meja',
            'quantity' => 40,
            'ruangan' => '1 A'
        ]);
    }
}
