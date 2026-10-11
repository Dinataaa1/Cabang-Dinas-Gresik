<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed initial admin user
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_unauthenticated_user_cannot_access_user_management(): void
    {
        $response = $this->get(route('admin.users.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_admin_can_view_user_management(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
        $this->actingAs($admin);

        $response = $this->get(route('admin.users.index'));
        $response->assertStatus(200);
        $response->assertSee('Kelola Akun Admin');
        $response->assertSee('admin@gmail.com');
    }

    public function test_authenticated_admin_can_create_new_admin(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
        $this->actingAs($admin);

        $response = $this->post(route('admin.users.store'), [
            'name' => 'Admin Baru',
            'email' => 'baru@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'Admin Baru',
            'email' => 'baru@gmail.com',
        ]);
    }

    public function test_authenticated_admin_can_edit_admin_profile(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
        $this->actingAs($admin);

        $userToEdit = User::create([
            'name' => 'User Lama',
            'email' => 'lama@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->put(route('admin.users.update', $userToEdit->id), [
            'name' => 'User Edit',
            'email' => 'lama@gmail.com',
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'id' => $userToEdit->id,
            'name' => 'User Edit',
        ]);
    }

    public function test_admin_cannot_delete_themselves(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
        $this->actingAs($admin);

        $response = $this->delete(route('admin.users.destroy', $admin->id));
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
        ]);
    }

    public function test_admin_can_delete_another_admin(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
        $this->actingAs($admin);

        $userToDelete = User::create([
            'name' => 'User Hapus',
            'email' => 'hapus@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->delete(route('admin.users.destroy', $userToDelete->id));
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseMissing('users', [
            'id' => $userToDelete->id,
        ]);
    }
}
