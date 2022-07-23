<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */

    public function admin_can_create_a_user()
    {
        $this->actingAs($this->user)->get('/user');
        $role = Role::factory()->create();
        $response = $this->actingAs($this->user)
            ->json("POST" , '/user', [
                '_token'=>csrf_token(),
                'name' => 'irvan',
                'email' => 'irvana@gmail.com',
                'password' => 'inipassword',
                'role_id' => $role->id,
            ]);
        $this->assertDatabaseHas('users', [
            'email' => 'irvana@gmail.com',
        ]);

    }

    /** @test */

    public function admin_can_edit_existing_user()
    {
// user buka halaman daftar user
        $this->actingAs($this->user)->get('/user');
        $user = User::factory()->create();
        $role = Role::factory()->create();

        $response = $this->actingAs($this->user)
            ->json("PUT", '/user/'.$user->id, [
                'name' => 'irvan',
                'email' => 'irvjkjkjana@gmail.com',
                'password' => 'aman',
                'role_id' => $role->id,
            ]);
// check perubahan data di table user
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'irvjkjkjana@gmail.com',
        ]);

    }

    /** @test */
    public function admin_can_delete_existing_user()
    {

       $this->actingAs($this->user)->get('/user');
        $user = User::factory()->create();
        $role = Role::factory()->create();
// user delete request
        $this->post('/user/' . $user->id, [
            '_method' => 'DELETE',
        ]);

// check data di table user
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'email' => 'irvanaaa@gmail.com',
        ]);

    }
}
