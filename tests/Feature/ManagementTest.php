<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_dashboard()
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get(route('mgmt.admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Painel do Administrador');
    }

    public function test_attendant_cannot_access_admin_dashboard()
    {
        $attendant = User::create([
            'name' => 'Attendant Test',
            'email' => 'attendant@test.com',
            'password' => bcrypt('password'),
            'role' => 'attendant',
        ]);

        $response = $this->actingAs($attendant)->get(route('mgmt.admin.dashboard'));

        $response->assertStatus(403);
    }

    public function test_admin_can_create_attendant()
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->post(route('mgmt.admin.atendentes.store'), [
            'name' => 'New Attendant',
            'email' => 'new@attendant.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('mgmt.admin.atendentes'));
        $this->assertDatabaseHas('users', ['email' => 'new@attendant.com', 'role' => 'attendant']);
    }

    public function test_admin_can_delete_attendant()
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $attendant = User::create([
            'name' => 'Delete Me',
            'email' => 'delete@me.com',
            'password' => bcrypt('password'),
            'role' => 'attendant',
        ]);

        $response = $this->actingAs($admin)->delete(route('mgmt.admin.atendentes.destroy', $attendant->id));

        $response->assertRedirect(route('mgmt.admin.atendentes'));
        $this->assertDatabaseMissing('users', ['id' => $attendant->id]);
    }
}
